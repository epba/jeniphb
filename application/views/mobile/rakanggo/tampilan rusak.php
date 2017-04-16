<!--   <script src="<?php echo base_url('assets/Template/jquery-ui-1.11.4/external/jquery/jquery.js')?>"></script>
-->
<!--   <script src="<?php echo base_url('assets/Template/jquery-ui-1.11.4/jquery-ui.min.js')?>"></script>
--><!-- <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.1/jquery.mobile-1.4.1.min.css">
  <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script> -->
<!-- <script src="http://code.jquery.com/mobile/1.4.1/jquery.mobile-1.4.1.min.js"></script>
--><!-- Scripts -->
<!-- <link rel='stylesheet' href='<?php echo base_url('assets/jquery_crop/css/jquery.Jcrop.css')?>' type='text/css'')?> 
  <script src="<?php echo base_url('assets/jquery_crop/js/jquery.Jcrop.js')?>"></script> -->
<!--   <link rel="stylesheet" href="<?php echo base_url('assets/Template/js/portfolio/photoswipe.css')?>">
-->  
  <!-- <script type="text/javascript" src="<?php echo base_url('assets/Template/js/portfolio/klass.min.js')?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/Template/js/portfolio/code.photoswipe.jquery-3.0.4.min.js')?>"></script> -->
<!--   <script src="<?php echo base_url('assets/Template/js/slider/jquery.flexslider-min.js')?>"></script>
-->  
<script type="text/javascript">
/*  function refreshPage()
  {
    jQuery.mobile.changePage(window.location.href,
    {
      allowSamePageTransition: true,
      transition: 'none',
      reloadPage: true});
    }
errrrrrrrrrrrrrr
    function refreshPage() {
      jQuery.mobile.pageContainer.pagecontainer('change', window.location.href, {

       allowSamePageTransition: true,
       transition: 'none',
       reloadPage: true
     });
    }

    $(document).on("click", '#refresh', function(){
      refreshPage();
    });*/

    $(document).bind("mobileinit", function() {
      $.mobile.loadingMessage = 'Please wait';
      $.mobile.pageLoadErrorMessage = 'There was an error, please trying again.';
    });
  </script>


<!-- social -->
    <!-- <div class="social"> <a href="#"><img src="images/social/facebook.png" alt="facebook"></a> <a href="#"><img src="images/social/twitter.png" alt="twitter"></a> <a href="#"><img src="images/social/google.png" alt="google"></a> <a href="#"><img src="images/social/dribbble.png" alt="dribble"></a> <a href="#"><img src="images/social/pinterest.png" alt="pintarest"></a> </div> -->
    <!-- /social --> 

    <!-- main content -->
    <!-- <div data-role="content" > -->
    <!-- <hr class="blankseparator"/> -->
    <!-- <div data-role="controlgroup" >
      <ul data-role="listview" data-inset="true" id="listview">
        <li><a href="about.html" data-prefetch data-transition="flip">About</a></li>
        <li><a href="portfolio.html" data-prefetch data-transition="fade">Portfolio</a></li>
        <li><a href="blog.html" data-prefetch data-transition="turn">Blog</a></li>
        <li><a href="features.html" data-prefetch data-transition="slidedown">Features</a></li>
        <li><a href="contact.html" data-prefetch data-transition="pop">Contact</a></li>
      </ul>
    </div> -->
    <!-- <hr class="blankseparator"/>
    <h2>New Site Template</h2>
    <p>Trixy is latest <strong>Mobile</strong> Site Template on sale. Trixy Template is simple and clean template with a lot attention to detail. It is suitable for a lot of <span class="green">different</span> business and private uses.</p>
    <p class="quote">Etiam eget mi enim, non ultricies nisi voluptatem, illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo nemo enim ipsam voluptatem.</p>
    <a href="#" title="" class="buttonhome">&rarr; download</a>
    <hr class="blankseparator"/> -->
    <!-- list begins -->
   <!--  <div class="alist" style="margin-bottom:0px">
      <h3>Latest Work</h3>
      <div class="thumbnail-list">
        <ul  data-inset="true" data-role="listview" data-filter-theme="f" >
          <li class="ui-btn-icon-right">
            <div class="ui-btn-inner ui-li" aria-hidden="true">
              <div class="ui-btn-text"> <a class="ui-link-inherit" href="blogsingle.html"> <img class="ui-li-thumb" src="images/thumbs/thumb1.jpg" alt="">
                <h3 class="ui-li-heading">Latest Post</h3>
                <p class="ui-li-desc">Sed perspiciatis</p>
              </a> </div>
              <span class="ui-icon ui-icon-arrow-r ui-icon-shadow"></span> </div>
            </li>
            <li class="ui-btn-icon-right">
              <div class="ui-btn-inner ui-li" aria-hidden="true">
                <div class="ui-btn-text"> <a class="ui-link-inherit" href="blogsingle.html"> <img class="ui-li-thumb" src="images/thumbs/thumb2.jpg" alt="">
                  <h3 class="ui-li-heading">Post one</h3>
                  <p class="ui-li-desc">Sed perspiciatis</p>
                </a> </div>
                <span class="ui-icon ui-icon-arrow-r ui-icon-shadow"></span> </div>
              </li>
              <li class="ui-btn-icon-right">
                <div class="ui-btn-inner ui-li" aria-hidden="true">
                  <div class="ui-btn-text"> <a class="ui-link-inherit" href="blogsingle.html"> <img class="ui-li-thumb" src="images/thumbs/thumb3.jpg" alt="">
                    <h3 class="ui-li-heading">Post two</h3>
                    <p class="ui-li-desc">Sed perspiciatis</p>
                  </a> </div>
                  <span class="ui-icon ui-icon-arrow-r ui-icon-shadow"></span> </div>
                </li>
                <li class="ui-btn-icon-right">
                  <div class="ui-btn-inner ui-li" aria-hidden="true">
                    <div class="ui-btn-text"> <a class="ui-link-inherit" href="blogsingle.html"> <img class="ui-li-thumb" src="images/thumbs/thumb4.jpg" alt="">
                      <h3 class="ui-li-heading">Post two</h3>
                      <p class="ui-li-desc">Sed perspiciatis</p>
                    </a> </div>
                    <span class="ui-icon ui-icon-arrow-r ui-icon-shadow"></span> </div>
                  </li>
                </ul>
              </div>
            </div>
            <!-- list ends -->
            <!-- <hr class="blankseparator"/>
            <div class="quote1">
              <h3 class="home-title">&quot; Beautiful images are from Mark Sebastian. Find him on Flickr <a href="http://www.flickr.com/photos/markjsebastian/">markjsebastian</a>.&quot;</h3>
              <h4><strong>Johha Smith | Trixy Agency</strong></h4>
            </div> -->
            <!-- end quote --> 

            <!-- </div> -->
            <!-- /main content --> 

            <!-- footer -->
         <!--  <div data-role="footer" class="footer">

            <div class="ui-grid-a">
              <div class="ui-block-a">
                <div class="ui-bar ui-bar-e" style="height:120px">
                  <h3>Latest News</h3>
                  <ul>
                    <li class="lines"><a href="http://www.anarieldesign.com/my-store/" title=""  rel="nofollow">My Store</a></li>
                    <li class="lines"><a href="http://www.anarieldesign.com/my-store/" class=""  rel="nofollow">Latest News</a></li>
                    <li class="lines"><a href="https://creativemarket.com/anarieldesign/1356-Special-Bundle" class=""  rel="nofollow">Creative Market</a></li>
                  </ul>
                </div>
              </div>
              <div class="ui-block-b">
                <div class="ui-bar ui-bar-e" style="height:120px">
                  <h3>Archives</h3>
                  <ul>
                    <li class="lines"><a href="#" title="">Latest News</a></li>
                    <li class="lines"><a href="#" class="">Portfolio News</a></li>
                    <li class="lines"><a href="#" class="">Responsive Theme</a></li>
                  </ul>
                </div>
              </div>
            </div> -->
            <!-- /grid-b -->

           <!--  <div id="copyright">
              <p class="copyright">&copy; Copyright 2012. &quot;Trixy Mobile&quot; by <a href="http://www.anarieldesign.com/" rel="nofollow">Anariel Design</a>. All rights reserved.</p>
            </div>
          </div> -->
          <!-- /footer --> 
          <!-- </div> -->
          <!-- /page --> 
        /*feedall*/
 /* $this->db->select('*');    
  $this->db->from('feed');
  $this->db->join('alumni', 'alumni.id_al = feed.id_al ');
  $where = "alumni.id_al = `feed.id_al` AND alumni.id_sklh = '$id_sklh'";
  $this->db->where($where);
  $this->db->order_by('time_feed', 'ASC');
  $this->db->limit(5);
  $sql = $this->db->get();
  foreach ($sql->result() as $row) {
    $data['id_al'][] = $row->id_al;
    $data['nama_al'][] = $row->nama_al;
    $data['isi_feed'][] = $row->isi_feed;
    $data['time_feed'][] = $row->time_feed;
    $data['foto_feed'][] = $row->foto_al;
  }
  $data['jlh'] = $sql->num_rows();
*/


<ul data-role="listview" data-inset="true">
  <li>
    <div class="less">
     <?php echo $row->isi_lok ?>
    </div>
    <div class="text-size">Read more...</div>
  </li>
</ul> 
</div>

<?php } ?> 
<script type="text/javascript">
  $(document).bind('pageshow', function() {
    $(".text-size").click(function(){
      $(".ui-li > div").toggleClass("less");
      if($(".text-size").html() == "Read more...")
      {
        $(".text-size").html("Read less...");
      }
      else
      {
        $(".text-size").html("Read more...");
      }
    });
  });
</script>
<style type="text/css">
  .less{
    word-wrap: break-word;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
}

.more{
    white-space: normal;
}

.text-size{
    display: block;
    text-align: right;
    padding-top: 10px;
    color: blue !important;
    cursor: pointer;
}
</style>


 <div id="myTabContent" class="tab-content wellwhite" style="margin-top: -21px">
      <div class="tab-pane fade in active" id="home">
        <p>
          <ul class="nav-list" style="margin-left: 0px">
          <!--   <?php
            $q_berita_populer = $this->db->query("SELECT * FROM berita ORDER BY hits DESC LIMIT 5")->result();

            foreach ($q_berita_populer as $d1) {
              echo "<li><a href='".base_URL()."index.php/tampil/blog/baca/".$d1->id."/".getURLFriendly($d1->judul)."'>".$d1->judul."</a></li>";

            }       
            ?> -->
          </ul>   


        </p>
      </div>
      <div class="tab-pane fade" id="profile">
        <p>
                          
              <ul class="nav-list" style="margin-left: 0px"> 
               <!--  <?php
                $q_berita_tag = $this->db->query("SELECT kat.id, kat.nama AS nama, COUNT(kategori) AS jml FROM berita, kat WHERE berita.kategori = '9-10-' GROUP BY kat.nama ORDER BY jml DESC")->result();

                foreach ($q_berita_tag as $d2) {
                  echo "<li><a href='".base_URL()."index.php/tampil/kategori/".$d2->id."'>".$d2->nama." <span class='badge'>".$d2->jml."</span></a></li>";

                }       
                ?> -->
              </ul>
            </p>
          </div>


          <div class="tab-pane fade" id="link">
            <p>
              <ul class="nav-list" style="margin-left: 0px">
               <!--  <?php 
                $q_link   = $this->db->query("SELECT * FROM link LIMIT 5")->result();
                foreach ($q_link as $ql) {
                  ?>
                  <li><a style="font-style: italic" href="<?=$ql->alamat?>" target="blank"><?=$ql->nama?></a></li>
                  <?php 
                }
                ?> -->

              </ul>


            </p>
          </div>
      <!--   </form>
      </p>
    </div>-->   </div>
    function chat()
{
  $teman = $this->db->where('id_al !=', $this->id )->get('alumni');
  $this->load->view('mobile/chat', array(
    'teman' => $teman
    ));
}


public function getChats()
{
  header('Content-Type: application/json');
  if ($this->input->is_ajax_request()) {
            // Find friend
    $friend = $this->db->get_where('alumni', array('id_al' => $this->input->post('chatWith')),1)->row();

            // Get Chats
    $chats = $this->db
    ->select('chat.*, alumni.nama_al, alumni.foto_al')
    ->from('chat')
    ->join('alumni', 'chat.send_by = alumni.id_al')
    ->where('(send_by = '. $this->id .' AND send_to = '. $friend->id_al .')')
    ->or_where('(send_to = '. $this->id .' AND send_by = '. $friend->id_al .')')
    ->order_by('chat.time', 'desc')
    ->limit(100)
    ->get()
    ->result();

    $result = array(
      'nama_al' => $friend->nama_al,
      'foto_al' => $friend->foto_al,
      'chats' => $chats
      );
    echo json_encode($result);
  }
}

public function sendMessage()
{
  $this->db->insert('chat', array(
    'message' => htmlentities($this->input->post('message', true)),
    'send_to' => $this->input->post('chatWith'),
    'send_by' => $this->id
    ));
}