<?php 
$sekolah = $this->db->count_all("sekolah");
$perusahaan = $this->db->count_all("perusahaan");
$this->db->select('id_lok');
$this->db->where('verifikasi_lok',"1");
$loker = $this->db->get("loker")->num_rows();
?>
<div class="row">
  <div class="col-lg-4 col-xs-6">
   <!-- small box -->
   <div class="small-box bg-aqua">
    <div class="inner">
      <h3><?php echo $sekolah; ?></h3>
      <p>Sekolah</p>
    </div>
    <div class="icon">
      <i style="color:white;" class="fa fa-graduation-cap"></i>
    </div>
    <a href="<?php echo base_url(); ?>web_admin/data_sekolah" class="small-box-footer">
     Selengkapnya
     <i style="color:white;" class="fa fa-arrow-circle-right"></i>
   </a>
 </div>
</div>
<div class="col-lg-4 col-xs-6">
 <!-- small box -->
 <div class="small-box bg-green">
  <div class="inner">
    <h3><?php echo $perusahaan; ?></h3>
    <p>Perusahaan</p>
  </div>
  <div class="icon">
    <i style="color:white;" class="fa fa-industry "></i>
  </div>
  <a href="<?php echo base_url(); ?>web_admin/data_perusahaan" class="small-box-footer">
   Selengkapnya
   <i style="color:white;" class="fa fa-arrow-circle-right"></i>
 </a>
</div>
</div>
<div class="col-lg-4 col-xs-12">
 <!-- small box -->
 <div class="small-box bg-red">
  <div class="inner">
    <h3><?php echo $loker; ?></h3>
    <p>Lowongan Kerja</p>
  </div>
  <div class="icon">
    <i style="color:white;" class="fa fa-newspaper-o"></i>
  </div>
  <a href="<?php echo base_url(); ?>web_admin/data_loker" class="small-box-footer">
   Selengkapnya
   <i style="color:white;" class="fa fa-arrow-circle-right"></i>
 </a>
</div>
</div>