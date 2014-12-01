<?php
    $this->load->view("template/header_view");
    $this->load->view("template/nav_view");
?>

<?php
foreach ($query->result() as $row) {
    $idPro = $row->idPro;
    $namePro = $row->namePro;
}
?>
<h1>
    Bienvenue, <?php echo $this->session->userdata('nameDev') ;?> !
</h1>

<h2>
    Ce projet s'intitule : <?php echo $namePro ;?>.
</h2>
<?php
$this->load->view("template/footer_view");
?>
