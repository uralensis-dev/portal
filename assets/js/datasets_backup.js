selected_items = [];
jQuery(document).ready(function(){

    var dataset_suggest = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: APP_URL+'/doctor/dataset_autosuggest?query=%QUERY',
            wildcard: '%QUERY',
            transform: function (dataset_suggest) {
                return $.map(dataset_suggest, function (items) {
                    return {
                        dataset_id: items.ura_datasets_id,
                        dataset_name: items.ura_datasets_name
                    };
                });
            }
        }
    });

    var timer;
    $('input.search_dataset').typeahead({
        minLength: 1,
        highlight: true
    },
    {
        name: 'search_dataset',
        source: dataset_suggest,
        display: function (item) {
            return item.dataset_name;
        },
        limit: 30,
        templates: {
            suggestion: function (item) {
                return '<div>' + item.dataset_name + '</div>';
            },
            notFound: function (query) {
                return 'No Result Found...';
            },
            pending: function (query) {
                return '<div>Loading...<i class="fa fa-circle-o-notch fa-spin pull-right" style="font-size:20px;"></i></div>';
            },
        }
    }).on('typeahead:selected', function (event, selection) {
        var _this = $(this);

        var dataset_id = selection.dataset_id;
        clearInterval(timer);
        timer = setTimeout(function (e) {
            jQuery.ajax({
                url: APP_URL + '/doctor/fetchDatasetCats',
                type: 'POST',
                dataType: 'json',
                data: {'dataset_id': dataset_id},
                beforeSend: function () {
                    $("#ajax_loading_effect").fadeIn();
                },
                success: function (data) {
                    if (data.type === 'error') {
                        $("#ajax_loading_effect").fadeOut();
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    } else {
                        window.setTimeout(function () {
                            var stepshtml = '';  
                            _.templateSettings.variable = "rc";
            console.log(data);
                            stepshtml = stepshtml.concat('<div class="tg-navtitle">');
                            stepshtml = stepshtml.concat('<h3>'+data.dataset_name+'</h3>');
                            stepshtml = stepshtml.concat('</div>');

                            stepshtml = stepshtml.concat('<div class="tg-verticalscrollbar dataset_cat_ques_list">');
                            stepshtml = stepshtml.concat('<nav id="tg-dashboardnav" class="tg-dashboardnav">');
                            stepshtml = stepshtml.concat('<ul>');
                            
                            var datasets = {};
                            window.datasets = data.datasets;
                            window.dataset_name = data.dataset_name;
                            window.dataset_id = data.dataset_id;
                            window.app_url = APP_URL;

                            var template_sidebar = _.template(
                                $("script#question_result_sidebar").html()
                            );
                        
                            var templateSidebarData = {
                                dataset_id : data.dataset_id,
                                app_url : APP_URL,
                                dataset_name : data.dataset_name,
                                datasets_data : data.datasets
                            };

                            $.each( data.datasets, function( key, value ) {

                                stepshtml = stepshtml.concat('<li data-catindex='+key+' data-catid='+value.cat_id+' class="tg-packagesnoti dataset_cat_id_'+value.cat_id+' menu-item-has-children page_item_has_children">');
                                stepshtml = stepshtml.concat('<a href="javascript:void(0);"><i class="fa fa-circle"></i>');
                                stepshtml = stepshtml.concat('<span>'+value.cat_name+'</span>');
                                stepshtml = stepshtml.concat('</a>');
                                stepshtml = stepshtml.concat('<ul class="sub-menu children">');

                                if (typeof value.questions != "undefined"  
                                    && value.questions != null  
                                    && value.questions.length != null  
                                    && value.questions.length > 0) {

                                        $.each( value.questions, function( ques_key, ques_value ) {
                                            stepshtml = stepshtml.concat('<li data-quesindex='+ques_key+'>');
                                            stepshtml = stepshtml.concat('<a href="#" class="question_title dataset_ques_id_'+ques_value.ques_id+'" data-quesid='+ques_value.ques_id+' data-questype='+ques_value.type+'>');
                                            stepshtml = stepshtml.concat(ques_value.title);
                                            stepshtml = stepshtml.concat('</a>');
                                            stepshtml = stepshtml.concat('</li>');
                                        });
                                        
                                } else {
                                    stepshtml = stepshtml.concat('<li><a href="javascript:;">No Question Added Yet!</a></li>');
                                }
                                
                                stepshtml = stepshtml.concat('</ul>');
                                stepshtml = stepshtml.concat('</li>');
                                
                            });

                            stepshtml = stepshtml.concat('</ul>');
                            stepshtml = stepshtml.concat('</nav>');
                            stepshtml = stepshtml.concat('</div>');

                            stepshtml = stepshtml.concat('<div class="tg-navbtn">');
                            stepshtml = stepshtml.concat('<a href="javascript:void(0);" class="tg-btn">Edit This Dataset</a>');
                            stepshtml = stepshtml.concat('</div>');

                            _this.parents('.datasets_filter').find('.load_dataset_data').html(stepshtml);
                            $("#load_ques_sidebar_data").html(template_sidebar(templateSidebarData));
                            getQuestionTemplate();
                            collapseMenuAndScroll();
                            $("#ajax_loading_effect").fadeOut();
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        }, 600);
                    }
                }
            });
        }, 600);
    });
});

/**
 * Print Html
 * @param {*} elem 
 */
function PrintHtml(elem) {
    var mywindow = window.open('', 'PRINT', 'height=850,width=1200,align=center');

    mywindow.document.write('<html><head><title>' + document.title  + '</title>');
    mywindow.document.write('</head><body >');
    mywindow.document.write('<h1>' + document.title  + '</h1>');
    mywindow.document.write(document.getElementById(elem).innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
}

/**
 * Get Question Template on Click
 */
function getQuestionTemplate() {
    $(document).on('click', '.question_title', function(e) {
        e.preventDefault();
        var _this = $(this);
        var temp_data = [];
        var pagination = false;
        _this.parent('li').addClass('active').siblings().removeClass('active');
        let ques_id = _this.data('quesid');

        _.templateSettings.variable = "rc";

        var ques_array = _(datasets).
            chain().
            pluck('questions').
            flatten().
            value();

        var ques_data = getArrayIndexData(ques_array, 'ques_id', ques_id);

        var template = _.template(
            $("script#question_temp").html()
        );

        if (typeof ques_data != "undefined"  
            && ques_data != null) {
                pagination = true;
                temp_data['type'] = ques_data.type;
                temp_data['cat_id'] = ques_data.cat_id;
                temp_data['id'] = ques_data.ques_id;
                temp_data['title'] = ques_data.title;
                temp_data['ans_id'] = ques_data.answer_data.ans_id;
                temp_data['ans_title'] = ques_data.answer_data.answer;
                temp_data['ans_ques_id'] = ques_data.answer_data.ans_ques_id;
                temp_data['db_answer_list'] = ques_data.db_answer_list; 
        }

        var templateData = {
            ques_data: temp_data,
            nav: pagination,
            current_ques_index: getArrayIndex(ques_array, 'ques_id', ques_id)
        };

        $("#load_ques_template_data").html(template(templateData));

    });
}

/**
 * Get First Index Question On Collapse
 * @param {*} cat_id 
 * @param {*} cat_index 
 * @param {*} ques_index 
 */
function getFirstQuestionOnCollapse(cat_id, cat_index, ques_index) {
    
    var cat_data = getArrayIndexData(datasets, 'cat_id', cat_id);

    var temp_data = [];

    _.templateSettings.variable = "rc";

    var pagination = false;

    if (typeof cat_data.questions != "undefined"  
            && cat_data.questions != null  
            && cat_data.questions.length != null  
            && cat_data.questions.length > 0) {

                let ques_data = cat_data.questions[0];

                pagination = true;
                
                temp_data['type'] = ques_data.type;
                temp_data['cat_id'] = ques_data.cat_id;
                temp_data['id'] = ques_data.ques_id;
                temp_data['title'] = ques_data.title;
                temp_data['ans_id'] = ques_data.answer_data.ans_id;
                temp_data['ans_title'] = ques_data.answer_data.answer;
                temp_data['ans_ques_id'] = ques_data.answer_data.ans_ques_id; 
                temp_data['db_answer_list'] = ques_data.db_answer_list; 

    }

    var template = _.template(
        $("script#question_temp").html()
    );

    var templateData = {
        ques_data: temp_data,
        nav: pagination,
        current_cat_index: cat_index,
        current_ques_index: ques_index
    };

    $("#load_ques_template_data").html(template(templateData));
    
}

/**
 * Get Previous Question Pagination
 * @param {*} ques_index 
 * @param {*} ques_id 
 * @param {*} cat_id 
 */
function prevQuestion(ques_index, ques_id, cat_id){
    var temp_data = [];
    var pagination = false;
    _.templateSettings.variable = "rc";

    var ques_array = _(datasets).
            chain().
            pluck('questions').
            flatten().
            value();

    var ques_data = ques_array[ques_index-1];

    activeCurrentQuestion(ques_index, cat_id, ques_id, 'prev');

    if(ques_index == 0){
        return false;
    }

    var template = _.template(
        $("script#question_temp").html()
    );

    if (typeof ques_data != "undefined"  
        && ques_data != null) {
            pagination = true;
            temp_data['cat_id'] = ques_data.cat_id;
            temp_data['type'] = ques_data.type;
            temp_data['id'] = ques_data.ques_id;
            temp_data['title'] = ques_data.title;
            temp_data['ans_id'] = ques_data.answer_data.ans_id;
            temp_data['ans_title'] = ques_data.answer_data.answer;
            temp_data['ans_ques_id'] = ques_data.answer_data.ans_ques_id;
            temp_data['db_answer_list'] = ques_data.db_answer_list; 
    }

    var templateData = {
        ques_data: temp_data,
        nav: pagination,
        current_ques_index: ques_index - 1,
        selected_items: selected_values
    };

    $("#load_ques_template_data").html(template(templateData));
}

/**
 * Get Next Question on Pagination
 * @param {*} ques_index 
 * @param {*} ques_id 
 * @param {*} cat_id 
 */
function nextQuestion(ques_index, ques_id, cat_id){
    var temp_data = [];
    var pagination = false;
    _.templateSettings.variable = "rc";

    var ques_array = _(datasets).
            chain().
            pluck('questions').
            flatten().
            value();
    
    //Check first if question is required...
    if(check_if_ques_is_required(ques_id) === true){

        if(runValidation(ques_id) === false){
            jQuery.sticky('Answer is required.', {classList: 'important', speed: 200, autoclose: 7000});
            return false;
        }
    }

    activeCurrentQuestion(ques_index, cat_id, ques_id, 'next');

    let question_title = 'question_'+ques_id;
    selected_items[question_title] = selectedValues(ques_id);
    window.selected_values = selected_items;

    var ques_data = ques_array[ques_index+1];

    //Prepare data for DB Insertion
    let prepare_data = [];
    prepare_data['dataset_id'] = ques_array[ques_index].dataset_id;
    prepare_data['cat_id'] = cat_id;
    prepare_data['ques_id'] = ques_id;
    prepare_data['ques_title'] = ques_array[ques_index].title;
    prepare_data['ques_type'] = ques_array[ques_index].type;
    prepare_data['ques_data'] = selectedValues(ques_id);

    var template = _.template(
        $("script#question_temp").html()
    );

    if (typeof ques_data != "undefined"  
        && ques_data != null) {
            pagination = true;
            temp_data['cat_id'] = ques_data.cat_id;
            temp_data['type'] = ques_data.type;
            temp_data['id'] = ques_data.ques_id;
            temp_data['title'] = ques_data.title;
            temp_data['ans_id'] = ques_data.answer_data.ans_id;
            temp_data['ans_title'] = ques_data.answer_data.answer;
            temp_data['ans_ques_id'] = ques_data.answer_data.ans_ques_id;
            temp_data['db_answer_list'] = ques_data.db_answer_list; 
    }

    var templateData = {
        ques_data: temp_data,
        nav: pagination,
        current_ques_index: ques_index + 1
    };

    $("#load_ques_template_data").html(template(templateData));
    //Save Question Data
    saveQuestionData(prepare_data);
    
    //For Displaying Answers Start
    var template_ans = _.template(
        $("script#question_result_sidebar").html()
    );

    var templateAnsData = {
        dataset_id : dataset_id,
        app_url : app_url,
        dataset_name : dataset_name,
        datasets_data : datasets,
        selected_items: selected_values
    };

    var _answers = template_ans(templateAnsData)

    $("#load_ques_sidebar_data").html(_answers);
    //For Displaying Answers End
    verticalscrollbarCustom();
    if(ques_array.length-1 == ques_index){
        return false;
    }
}

/**
 * Get Selected Answer Values
 * @param {*} ques_id 
 */
function selectedValues(ques_id){
    //Get question dom object
    let ques_obj = $('.dataset_question_'+ques_id);
    let ques_type = $('.dataset_question_'+ques_id).data('questype');
    switch (ques_type) {
        case 'multiplechoice':
            var items = [];
            $.each(ques_obj.find("input:checkbox:checked"), function(){
                items.push($(this).val());
            });
            return items;
            break;
        case 'singlechoice':
            var items = [];
            $.each(ques_obj.find("input:radio:checked"), function(){
                items.push($(this).val());
            });
            return items;
            break;
        case 'number':
            return ques_obj.find('input[type=number]').val();
            break;
        case 'textfield':
            return ques_obj.find('input[type=text]').val();
            break;
        case 'textarea':
            return ques_obj.find('textarea').val();
            break;
      }
}

/**
 * Save Question Data in DB
 * @param {*} prepare_data 
 */
function saveQuestionData(prepare_data){
    $.ajax({
        url: APP_URL + '/doctor/saveQuestionData',
        type: 'POST',
        dataType: 'json',
        data: {
            'dataset_id': prepare_data['dataset_id'],
            'cat_id': prepare_data['cat_id'],
            'ques_id' : prepare_data['ques_id'],
            'ques_type' : prepare_data['ques_type'],
            'ques_title' : prepare_data['ques_title'].toLowerCase().replace(/\s/g, '_'),
            'ques_data': prepare_data['ques_data']
        },
        success: function (response) {
            if (response.type === 'success') {
                jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
            } else {
                jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
            }
        }
    });
}

/**
 * Check Validation on Each Question
 * @param {*} ques_id 
 */
function runValidation(ques_id){
    //Get question dom object
    let ques_obj = $('.dataset_question_'+ques_id);
    let ques_type = $('.dataset_question_'+ques_id).data('questype');
    switch (ques_type) {
        case 'multiplechoice':
            if (!ques_obj.find('input:checkbox:checked').length > 0) {
                return false;
            }
            break;
        case 'singlechoice':
            if (!ques_obj.find('input:radio:checked').length > 0) {
                return false;
            }
            break;
        case 'number':
            if (!ques_obj.find('input[type=number]').val()) {
                return false;
            }
            break;
        case 'textfield':
            if (!ques_obj.find('input[type=text]').val()) {
                return false;
            }
            break;
        case 'textarea':
            if (!ques_obj.find('textarea').val()) {
                return false;
            }
            break;
      }
}

/**
 * Check if Question is Required
 * @param {*} ques_id 
 */
function check_if_ques_is_required(ques_id){
    var ques_array = _(datasets).
            chain().
            pluck('questions').
            flatten().
            value();

    var ques_data = getArrayIndexData(ques_array, 'ques_id', ques_id);
    
    if(ques_data.required === 'yes') {
        return true;
    }
}

/**
 * Activate Question on Pagination Next or Previous
 * @param {*} ques_index 
 * @param {*} catid 
 * @param {*} quesid 
 * @param {*} type 
 */
function activeCurrentQuestion(ques_index, catid, quesid, type){

    var ques_array = _(datasets).
            chain().
            pluck('questions').
            flatten().
            value();

    if(ques_array.length > 0 && ques_array !== null){
        if(type === 'next'){
            var ques_data = ques_array[ques_index+1];
        } else {
            var ques_data = ques_array[ques_index-1];
        }
        
        if(ques_data !== undefined && ques_data !== null) {
            let cat_id = ques_data.cat_id;
            let ques_id = ques_data.ques_id;
            if(cat_id && ques_id) {
                let cat_list_dom = jQuery('.dataset_cat_ques_list').find('.dataset_cat_id_'+cat_id);
                let ques_dom = jQuery('.dataset_cat_ques_list').find('.dataset_cat_id_'+cat_id+' .sub-menu .dataset_ques_id_'+ques_id);
                ques_dom.parent('li').siblings().removeClass('active');
                ques_dom.parent('li').addClass('active');
                if(catid != cat_id){
                    cat_list_dom.siblings().removeClass('tg-open');
                    if(type === 'next'){
                        cat_list_dom.prev().find('ul.sub-menu li').removeClass('active');
                        cat_list_dom.prev().find('ul.sub-menu').slideToggle(300);
                    } else {
                        cat_list_dom.next().find('ul.sub-menu li').removeClass('active');
                        cat_list_dom.next().find('ul.sub-menu').slideToggle(300);
                    }
                    cat_list_dom.addClass('tg-open');
                    cat_list_dom.find('ul.sub-menu').slideToggle(300);
                }
            }
        }
    }
    
}

/**
 * Get Array Index Data on ID
 * @param {*} array 
 * @param {*} attr 
 * @param {*} value 
 */
function getArrayIndexData(array, attr, value) {
    for (var i = 0; i < array.length; i += 1) {
        if (array[i][attr] == value) {
            return array[i]
        }
    }
    return -1
}

/**
 * Get Array Index on ID
 * @param {*} array 
 * @param {*} attr 
 * @param {*} value 
 */
function getArrayIndex(array, attr, value) {
    for (var i = 0; i < array.length; i += 1) {
        if (array[i][attr] == value) {
            return i
        }
    }
    return -1
}

/**
 * Collapse Category Dataset
 */
function collapseMenuAndScroll() {
    jQuery('.tg-dashboardnav ul li.menu-item-has-children, .tg-dashboardnav ul li.page_item_has_children, .tg-navigation ul li.menu-item-has-mega-menu').prepend('<span class="tg-dropdowarrow"><i class="fa fa-angle-down"></i></span>');
    jQuery('.tg-dashboardnav ul li.menu-item-has-children span, .tg-dashboardnav ul li.page_item_has_children span, .tg-navigation ul li.menu-item-has-mega-menu span').on('click', function () {
        var _this = $(this);
        let cat_id = _this.parents('li').data('catid');
        let cat_index = _this.parents('li').data('catindex');
        console.log(jQuery(this));
        jQuery(this).parent('li').toggleClass('tg-open');
        jQuery(this).next().next().slideToggle(300);
        if(_this.parents('li').hasClass('tg-open')){
            getFirstQuestionOnCollapse(cat_id, cat_index, 0);
            _this.parents('li').find('ul.children li:first').addClass('active');
        } else {
            _this.parents('li').find('ul.children li').removeClass('active');
        }
    });
    verticalscrollbarCustom();
}

function verticalscrollbarCustom(){
    console.log('From Next Button');
    if (jQuery('.tg-verticalscrollbar').length > 0) {
        var _tg_verticalscrollbar = jQuery('.tg-verticalscrollbar');
        _tg_verticalscrollbar.mCustomScrollbar({
            axis: "y",
        });
    }
}
