<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php

/**
 * Opinin Cases Class
 */
class Opinion_Cases 
{

    /**
     * Undocumented function
     *
     * @param int $record_id
     * @param array $opinion_data
     * @param array $opinion_data_reply
     * @return void
     */
    public static function display_comments($record_id, $opinion_data, $opinion_data_reply) 
    {
        $ci = & get_instance();
        $user_id = $ci->ion_auth->user()->row()->id;

        $ura_opinion_id = '';
        $opinion_doc_id = '';
        $opinion_comment = '';
        $opinion_status = '';
        if (!empty($opinion_data[0])) {
            $ura_opinion_id = $opinion_data[0]->ura_opinion_id;
            $opinion_doc_id = $opinion_data[0]->ura_opinion_doctor_id;
            $opinion_comment = $opinion_data[0]->ura_opinion_comments;
        }

        if (!empty($opinion_data_reply[0])) {
            $opinion_status = $opinion_data_reply[0]->ura_opinion_status;
        }
        $ci->load->model("Doctor_model");
        $getNewOpinionData = $ci->Doctor_model->get_opinion_all_comments_reply($record_id);
//        echo "Hello Shariq Ali";
//        echo "<pre>";print_r($getNewOpinionData);exit;
        ?>
        <div class="container-fluid" style="padding-right: 110px;">
            <div class="col-md-12">
                <div class="sec_title form-group">
                    Opinion Comments</a>
                </div>
                <div class="card">
                    <form class="form opinion_cases_comment" id="opinion_cases_comments">
                    <div class="card-body">
                        <?php foreach ($getNewOpinionData as $opiniondata){ ?>
                            <div class="chat chat-left">
                                
                                <div class="chat-body">
                                    <div class="chat-bubble">
                                        <div class="chat-content">
                                            <div class="chat-avatar">
                                    <?php
                                    $userData=getUserMetaDetail($opiniondata->ura_opinion_doctor_id, $type = 'profile_picture_path', $table = 'users');
                                    if(file_exists($userData[0]['profile_picture_path'])){
                                        $imageUrl = base_url($userData[0]['profile_picture_path']);
                                    } else {
                                        $imageUrl = base_url("assets/img/dummy-doctors.jpg");
                                    }
                                    ?>
                                    <a href="javascript:;" class="avatar chat_image">
                                        <img alt="" src="<?php echo $imageUrl; ?>" class="img-fluid">
<!--                                        --><?php //echo "<pre>";print_r($userData);?>
                                    </a>
                                </div>
                                            <span class="task-chat-user"><?php echo get_uralensis_username($opiniondata->ura_opinion_doctor_id);?></span> <span class="chat-time"><?php echo date("d-M-Y h:i A",$opiniondata->ura_opinion_date);?></span>
                                            <span>
                                                <p><?php echo $opiniondata->ura_opinion_comments; ?></p>
                                            </span>
                                            <p style="margin-top: 15px;">
                                            <ul class="list-inline">
                                                <li>
                                                    <a href="javascript:;" class="btn <?php echo (check_comment_like($user_id,$opiniondata->ura_opinion_id)?"btn-success disabled":"btn-primary")?> btn-sm btn-rounded btn-commment-like" data-id="<?php echo $opiniondata->ura_opinion_id; ?>"  title="Like">
                                                        <i class="fa fa-thumbs-up"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <span class="opinion_commentss" style="display: none"><?php echo $opiniondata->ura_opinion_comments; ?></span>
                                                    <a href="#opinion_reply_label" class="btn btn-success btn-sm btn-rounded btn-commment-edit" data-id="<?php echo $opiniondata->ura_opinion_id; ?>" title="Edit">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                </li>
                                                <?php if($opiniondata->ura_opinion_doctor_id==$user_id){?>
                                                    <li>
                                                        <a href="javascript:;" class="btn btn-danger btn-sm btn-rounded btn-commment-delete" data-id="<?php echo $opiniondata->ura_opinion_id; ?>" title="Delete">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </li>
                                                <?php }?>
                                            </ul>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        ?>
                        <div class="form-group" id="opinion_reply_label">
                            <label for="opinion_reply">Reply to this opinion.</label>
                            <textarea rows="3" class="form-control" name="opinion_reply" id="opinion_reply"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="list-inline custom_list_opi" style="margin-top: 18px;">
                                        <li>
                                            <a href="javascript:;"
                                               class="btn btn-default btn-block btn-comment-text">Consensus Opinion</a>
                                        </li>
                                        <li>
                                            <a href="javascript:;"
                                               class="btn btn-default btn-block btn-comment-text">Difficult Case</a>
                                        </li>
                                        <li>
                                            <a href="javascript:;"
                                               class="btn btn-default btn-block btn-comment-text">Not sure if benign or malignant</a>
                                        </li>
                                        <li>
                                            <a href="javascript:;"
                                               class="btn btn-default btn-block btn-comment-text">Looks inflammatory</a>
                                        </li>
                                        <li>
                                            <a href="javascript:;"
                                               class="btn btn-default btn-block btn-comment-text">Any dysplasia?</a>
                                        </li>
                                        <li>
                                            <a href="javascript:;"
                                               class="btn btn-default btn-block btn-comment-text">Wonder if malignant</a>
                                        </li>
                                        <li>
                                            <a href="javascript:;"
                                               class="btn btn-default btn-block btn-comment-text">Thank You</a>
                                        </li>
                                        <li>
                                            <a href="javascript:;"
                                               class="btn btn-default btn-block btn-comment-text">Think it is benign?</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="is_edit_status"  id="is_edit_status">
                            <input type="hidden" name="is_opinion_id"  id="is_opinion_id">
                            <input type="hidden" value="<?php echo $ura_opinion_id; ?>" name="ura_opinion_id"  id="ura_opinion_id">
                            <input type="hidden" value="" name="opinion_reply_date"  id="opinion_reply_date">
                            <input type="hidden" name="record_id" value="<?php echo $record_id; ?>" />
                            <input type="hidden" name="opinion_doctor_id" value="<?php echo $opinion_data[0]->ura_opinion_doctor_id; ?>" />
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-rounded add_opinion_reply" style="margin-top: 10px;">Reply</button>
                            <button class="btn btn-primary btn-rounded btn_reply_cancel" style="margin-top: 10px;display: none">Cancel</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            $(document).on('click',".btn-comment-text", function () {
                var preText = $("#opinion_reply").val();
                preText += " "+$(this).text();
                $("#opinion_reply").val(preText);
            });
        </script>
<!--        <div class="well">-->
<!--            <form class="form opinion_cases_comment">-->
<!--                <i style="color:red;">Note : Do Not Write Any Script or any HTML here. Add Just Text Here --><?php //echo $record_id;?><!--.</i>-->
<!--                <div class="form-group">-->
<!--                    <p><strong>--><?php //echo get_uralensis_username($opinion_doc_id); ?><!-- &nbsp;:&nbsp;</strong>--><?php //echo $opinion_comment; ?><!--</p>-->
<!--                    --><?php
//                    if (!empty($opinion_data_reply)) {
//
//                        foreach ($opinion_data_reply as $key => $value) {
//                            $username = get_uralensis_username($value->ura_opinion_doctor_id);
//                            echo '<p><strong>' . $username . '&nbsp;:&nbsp;</strong>' . $value->ura_opinion_comments . '</p>';
//                        }
//                    }
//                    ?>
<!--                </div>-->
<!--                --><?php //if ($user_id != $opinion_doc_id && $opinion_status != 'true') { ?>
<!--                    <div class="form-group">-->
<!--                        <label for="opinion_reply">Reply to this opinion.</label>-->
<!--                        <textarea rows="3" class="form-control" name="opinion_reply" id="opinion_reply"></textarea>-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <input type="hidden" value="--><?php //echo $ura_opinion_id; ?><!--" name="ura_opinion_id"  id="ura_opinion_id">-->
<!--                        <input type="hidden" value="" name="opinion_reply_date"  id="opinion_reply_date">-->
<!--                        <input type="hidden" name="record_id" value="--><?php //echo $record_id; ?><!--" />-->
<!--                        <input type="hidden" name="opinion_doctor_id" value="--><?php //echo $opinion_data[0]->ura_opinion_doctor_id; ?><!--" />-->
<!--                    </div>-->
<!---->
<!--                    <div class="form-group">-->
<!--                        <button class="btn btn-primary btn-rounded add_opinion_reply" style="margin-top: 10px;">Reply</button>-->
<!--                    </div>-->
<!--                --><?php //} ?>
<!--            </form>-->
<!--        </div>-->
        <?php
    }
}

new Opinion_Cases();
