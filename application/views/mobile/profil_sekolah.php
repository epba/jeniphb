<ul data-role="listview" data-inset="true"  data-theme="c" style="margin:0px;">
 <li>
    <img width='35px' src="<?=base_URL()?>assets/upload/sekolah/<?php echo $sekolah[0]['logo_sklh']; ?>" style="padding-top:20px; padding-left:30px;">
    <h2><?php echo $sekolah[0]['nama_sklh'];  ?></h2>
<!--     <p style="color:red"> <?php echo $status[0]['isi_feed'] ;?></p>
-->

<p>
<a href="<?php echo base_url('mob_tampil/pesan/sekolah').$sekolah[0]['id_sklh'];?>" type="button"> <i class="fa fa-comments icon-border" aria-hidden="true"></i></a>
</p>


<center><?php echo $this->session->flashdata("k");?></center>

</li>
<li>



    <label><b>Username</b> </label>
    <br>
    <input type="text" name="username"  value="<?php echo $sekolah[0]['username_sklh'];  ?>" readonly >
</li>
<li>
    <label style="float: left"><b>Nama Sekolah</b></label><br>
    <input  type="text" name="nama"  value="<?php echo $sekolah[0]['nama_sklh']; ?>" readonly>


</li>
<li>
    <label style="float: left"><b>Alamat</b></label><br>
    <textarea type="text" name="alamat" readonly>  <?php echo $sekolah[0]['alamat_sklh'] ;?>
    </textarea></li>
    <li>
        <label style="float: left"><b>Phone</b></label><br>
        <input type="tel" name="phone" pattern="[0-9]*" value="<?php echo $sekolah[0]['cp_sklh'] ;?>" readonly></li>

        <li>
            <label style="float: left"><b>E-mail</b></label><br>
            <input  type="email" name="email" value=" <?php echo $sekolah[0]['email_sklh'] ;?>" readonly>
        </li>
        <li>
            <label style="float: left"><b>Fax</b></label><br>
            <input  type="email" name="email" value=" <?php echo $sekolah[0]['fax_sklh'] ;?>" readonly>
        </li>
        <?php
        if ($sekolah[0]['web_sklh']==null) {

        } else {?>
        <li> <label style='float: left'><b>Website</b></label><br>
            <input  type='text' name='kerja'  value='<?=$sekolah[0]['web_sklh']?>' readonly>
        </li>
        <?php
    }

    ?>


</li>
</ul>



<!-- <div data-role="fieldcontain">
    <fieldset data-role="controlgroup" data-type="horizontal">
        <legend>Flight details:</legend>
        <label for="select-cabin">Cabin type:</label>
        <select name="select-cabin" id="select-cabin">
            <option>Cabin type</option>
            <option value="economy">Economy</option>
            <option value="business">Business</option>
            <option value="first">First class</option>
        </select>
        <label for="select-adults">Adults</label>
        <select name="select-adults" id="select-adults">
            <option>Adults</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <!-- etc. -->
    <!--     </select>
        <label for="select-time">Time</label>
        <select name="select-time" id="select-time">
            <option>Time</option>
            <option value="6">6:00AM</option>
            <option value="7">7:00AM</option>
            <!-- etc.
        </select>
    </fieldset>
</div>
<br> 
-->


</div>
<!-- page  
 -->