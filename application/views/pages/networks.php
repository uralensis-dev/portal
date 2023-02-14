<h1>All networks</h1>
<div>
<ul>
    <?php foreach($networks as $network): ?>
        <li> <a href="<?php echo base_url('admin/network/'.$network['id'])?>"><?php echo $network['name'] ?></a> </li>
    <?php endforeach; ?>
</ul>
</div>

<button onclick="window.location.href=_base_url+'admin/new_network'">New Network</button>