        <?php echo $map['js']; ?>
        <?php echo $map['html']; ?>
        <div id="directionsDiv"></div>
    </div>
<!-- page  
-->

 <!-- <script>
    $(document).ready(function()
    {
        refresh();
    });

    function refresh()
    {
        setTimeout(function()
        { 
            var lastPart = window.location.href.split("/").pop();
            $('#directionsDiv').load('<?php echo base_url();?>mob_tampil/loker/track/'+lastPart);
            refresh();
        }, 30000);
    }
</script> -->





