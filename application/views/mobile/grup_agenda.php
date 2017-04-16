<ul data-role="listview" data-inset="true"  data-theme="c" style="margin:0px;">

   <?php
   for($i=0;$i<$jlh;$i++){
    ?>

    <li>

        <input  type="text" name="nama"  value="<?php echo $judul_ag[$i]; ?>" disabled>
        <table>
            <tbody>
                <tr>
                    <td>
                        <div class="gdate2">
                            <span class="day"><?php echo date("j", strtotime("{$time_ag[$i]}"));?></span>
                            <span class="month"><?php echo date("F", strtotime("{$time_ag[$i]}"));?></span>
                            <span class="month"><?php echo date("Y", strtotime("{$time_ag[$i]}"));?></span>
                        </div>
                    </td>

                    <td>
                        <p style="padding-left: 15px;"><?php echo $isi_ag[$i]; ?></p>
                    </td>
                    <tr>
                    <td><label class="fa fa-map-marker fa-1x">&nbsp;&nbsp;</label><?php echo $tmp_ag[$i]; ?></td>
                    <td><label class="fa fa-map-marker fa-1x" style="float: right">&nbsp;<?php echo $post_ag[$i]; ?></label></td>
                    </tr>
                </tbody>
            </table>
        </li>
       
            <?php
        }
        ?>
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