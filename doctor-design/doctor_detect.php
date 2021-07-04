<?php
session_start();
include "../User.php";
$user = new User();

$id = $_GET['pid'];
$_SESSION['patient_id'] = $id; // patient id

$patient_data  = $user->get_data($id);
$seq = $patient_data['seq'];

$snp = ["TAAATTGCAG", "TAGCTTGAGG", "TTAACATTTA", "GACTTGGAAC","AATGCTAAAG", "GAAAGCATTT", "GGCAATATTT", "ATTATAATTT",
		"AATTTTATAT", "AAAAATATTT", "AATTTCCTCT", "GGATAGTCAA", "ACCTGCCAGA", "TATCAAACCT", "GAGGAAGGCA", "GAAGTGAATT",
		"TGGAGAACTA", "GGGTAGAGAG", "AGGTTGCTAT", "AAAACGAGCA", "TTTGGAGGGC", "CCACGGCTTC", "ACTCAGGACC", "TGCTGGGCTT",
		"GTGTACCCCA", "GGAGCCCTTT", "TAAGTATCTT", "TTGTACGCTT", "TTCACCCCAC", "CCCCAAGTCC", "TGGGAGAAAT", "GCAGGCAACA",
		"CTGAGACATG", "GGAGAGGCCA", "AGATATGCTT", "GACAGAAAGG", "GTGATTTTGA", "GGCTCAGTTA", "ATATTTCAAA", "ATTGTAACCG",
		"TAGCAAAACT", "GCATTGGTAT", "TTAGAAAAAT", "AAAAAATTTC", "CAATATGTAG", "TGCTGTGTTA", "TACCTGCCTC", "TGCCATGCAG",
		"CATCATAGCC", "TGTGGGAACC", "GGAGGGCTTC", "CCTTACCACC", "CAGAGCAGAG", "GAGGAAGGTG", "ATGGAATATG", "GGGTGAGGGG", 
		"AGGAACCTGG", "TGGCCCCTCC", "CTGAGATGGC", "CAGAAAGCCC", "TTGGCCTCAC", "CTGGGACTGA", "CCAGGCAGCC", "CTAGTCTAGG",
		"CACAAGGTGC", "CCTTTCACCC","TTCATGGCTG", "TGGGAATATT", "TCCTCTTACT", "CTTTTTCTCC", "CATACAGCTA", "CTGCCAAAAT", 
		"GCCCAAACTT", "GGGCCAAATG","TTGCCCAAAC", "TTGGGCCAAA", "AATGTTGCCC", "AAGAGACCAA", "AACAGAGGAA", "AACAGTTTCC", 
		"AAATCTATGT", "AGATCATGAG","CAGAAATCTG", "AGGCTTGAAT", "AAAGGGCTGA", "GAGGGCAGGA", "GCTCTTTGGG", "GTGTCCAGAG", 
		"CAGACGCCCA", "TCCCAAGGAC","TTCCATGGAG", "TGGGGGGAAG", "GCTGGGTAGG", "TTTGAGTTTT", "ATCGTCAATA", "TAATAAATTA", 
		"ATCAGAAGCT", "TTCACAAAAC","AAACACCGCG", "GCTCCGCTGA"]; 

		$found = [];
		$cover_query = 0;

	for ($i = 0; $i < count($snp)-3; $i++) {
		if (strpos($seq, $snp[$i]) !== false && strpos($seq, $snp[$i+1]) !== false && strpos($seq, $snp[$i+2]) !== false){
				$cover_query++;
				$found[] = $snp[$i];
				$found[] = $snp[$i+1];
				$found[] = $snp[$i+2];	
			}
		}
if ($cover_query > 20) {
	$align_Res =  "Risk Ratio is : " . $cover_query . "% ";
}else{
	$align_Res =  "Risk Ratio is : " . $cover_query . "% ";
}

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Detect</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
	    <link rel="icon" type="image/png" href="../images/icons/targeted.ico"/>
		<noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<h1>Detect</h1>
						<p>Alignment of TP53 SNPs with your Uploaded gene sequence.</p>
					</header>

				<!-- Main -->
					<div id="main">

						<!-- Content -->
							<section id="content" class="main">
								<span class="image main"><img src="../images/dp.jpg" alt="" /></span>
							<div class="row">
								<div class="col-6 col-12-medium">
									<h3>Patient Data</h3> <i>(this data will be auto-filled when you click on the seq icon)</i>
									<ul class="alt">
										<li>Name 	:/&nbsp;  <?= $patient_data['name'] ?> </li>
										<li>Gender 	:/&nbsp;  <?= $patient_data['gender'] ?> </li>
										<li>Age 	:/&nbsp;  <?= $patient_data['age'] ?> </li>
									</ul>
								</div>
							</div>

								<div class="col-12">
									<textarea name="demo-message" id="demo-message" placeholder="The corresponding Sequence to the patient will be auto-pasted here and if not then he did not upload it Yet!." rows="6"><?= @$patient_data['seq'] ?></textarea>
								</div> <br>
								<!-- // Result will be printed below the table. -->
								<!-- <input type="submit" value="Align/Detect" class="primary" /> -->
								&nbsp; &nbsp; &nbsp; &nbsp; <?= $align_Res ?>
							<a href="doctor_profile.php" style="float: right;" class="button primary icon solidfa-download">Go Back</a>
						
							<br> <br> <br> <br> 	
						<h2>Type here your Recommendations - Reports - Comments</h2>
								<form method="post" action="doctor_profile.php">
									<div class="row gtr-uniform">
										<div class="col-12">
											<textarea name="message" id="demo-message" placeholder="Enter your prescriptions" rows="6"><?= @$patient_data['result'] ?></textarea>
										</div>
									<div class="col-12">
										<ul class="actions">
											<li><input type="submit" name="submit_Report" value="Send Report" class="primary" /></li>
											<li><input type="reset" value="Reset" /></li>
										</ul>
									</div>
								</div>
							</form>
						

						</div>
							<br>
							</section>
					</div>



				<?php include '../footer.html' ?>

			</div>

		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/jquery.scrollex.min.js"></script>
			<script src="../assets/js/jquery.scrolly.min.js"></script>
			<script src="../assets/js/browser.min.js"></script>
			<script src="../assets/js/breakpoints.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/main.js"></script>

	</body>
</html>