<?php
	header("Content-Type: application/vnd.ms-word");
	header("Expires: 0");
	header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
	header("Content-disposition: attachment; filename=laporan_rawat_inap.doc");
?>

<html>
<head>
	<STYLE TYPE="text/css">
	<!--
		@page { size: 8.5in 11in; margin: 1in }
		P { margin-bottom: 0.08in; direction: ltr; color: #000000; line-height: 107%; widows: 2; orphans: 2 }
		P.western { font-family: "Calibri", sans-serif; font-size: 11pt; so-language: en-US }
		P.cjk { font-family: "Calibri", sans-serif; font-size: 11pt }
		P.ctl { font-family: "Times New Roman", serif; font-size: 11pt; so-language: ar-SA }
	-->
	</STYLE>
<title>Pembuatan Laporan</title>
</head>

<?php 
				switch ($bulan) {
					case '01':
						$bulanID = "Januari";
						break;

					case '02':
						$bulanID = "Februari";
						break;

					case '03':
						$bulanID = "Maret";
						break;

					case '04':
						$bulanID = "April";
						break;

					case '05':
						$bulanID = "Mei";
						break;

					case '06':
						$bulanID = "Juni";
						break;

					case '07':
						$bulanID = "Juli";
						break;

					case '08':
						$bulanID = "Agustus";
						break;

					case '09':
						$bulanID = "September";
						break;

					case '10':
						$bulanID = "Oktober";
						break;

					case '11':
						$bulanID = "Nopember";
						break;

					case '12':
						$bulanID = "Desember";
						break;
				}
				?>

<body>
	
	<div>

		<P ALIGN=CENTER STYLE="margin-bottom: 0.11in; line-height: 100%"><FONT FACE="Times New Roman, serif"><FONT SIZE=5><B>LAPORAN
			BULANAN</B></FONT></FONT></P>
			<P ALIGN=CENTER STYLE="margin-bottom: 0.11in; line-height: 100%"><FONT FACE="Times New Roman, serif"><FONT SIZE=5><B>BAGIAN
			INSTALASI REKAM MEDIS</B></FONT></FONT></P>
			<P ALIGN=CENTER STYLE="margin-bottom: 0.11in; line-height: 100%"><FONT FACE="Times New Roman, serif"><FONT SIZE=5><B>RUMAH
			SAKIT WIJAYA KUSUMA</B></FONT></FONT></P>
			<P ALIGN=CENTER STYLE="margin-bottom: 0.11in; line-height: 100%"><FONT FACE="Times New Roman, serif"><FONT SIZE=5><B>
				<?php echo $bulanID; ?>
			</B></FONT></FONT></P>
			<P ALIGN=CENTER STYLE="margin-bottom: 0.11in; line-height: 100%"><FONT FACE="Times New Roman, serif"><FONT SIZE=5><B><?php echo $tahun; ?></B></FONT></FONT></P>
			<P ALIGN=CENTER STYLE="margin-bottom: 0.11in"><BR><BR>
			</P>
			<P ALIGN=CENTER STYLE="margin-bottom: 0.11in"><IMG SRC="<?php echo base_url() ?>assets/img/data_dokument_html_8249f713.gif" NAME="Picture 1" ALIGN=BOTTOM WIDTH=323 HEIGHT=323 BORDER=0></P>
			<P ALIGN=CENTER STYLE="margin-bottom: 0.11in"><BR><BR>
			</P>
			<P ALIGN=CENTER STYLE="margin-bottom: 0.11in"><BR><BR>
			</P>
			<P ALIGN=CENTER STYLE="margin-bottom: 0.11in"><BR><BR>
			</P>
			<P ALIGN=CENTER STYLE="margin-bottom: 0.11in"><BR><BR>
			</P>
			<P ALIGN=CENTER STYLE="margin-bottom: 0.11in"><BR><BR>
			</P>
			<P ALIGN=CENTER STYLE="margin-bottom: 0.11in"><FONT FACE="Times New Roman, serif"><FONT SIZE=3>Lumajang,
			<?php echo date("d-m-Y");?></FONT></FONT></P>
			<P STYLE="margin-bottom: 0.11in"><BR><BR>
			</P>

			<P ALIGN=CENTER STYLE="margin-bottom: 0.11in; page-break-before: always">
			<FONT FACE="Times New Roman, serif"><FONT SIZE=3><B>HASIL KEGIATAN
			RAWAT INAP</B></FONT></FONT></P>
			<P ALIGN=CENTER STYLE="margin-bottom: 0.11in"><BR><BR>
			</P>

			<!-- start 1 -->

			<OL>
				<LI><P STYLE="margin-bottom: 0.11in"><FONT FACE="Times New Roman, serif"><FONT SIZE=3>Asal
				pasien (kecamatan) yang berobat rawat inap bulan <?php echo $bulanID; ?> <?php echo $tahun; ?></FONT></FONT></P>
			</OL>


			<table border="1" WIDTH=575 CELLPADDING=7 CELLSPACING=0>
				
				<tr valign=top>
					<th CLASS="western" ALIGN=CENTER>NO</th>
					<th CLASS="western" ALIGN=CENTER>KECAMATAN</th>
					<th CLASS="western" ALIGN=CENTER>JUMLAH PASIEN</th>
				</tr>

				<?php

				$kecs = mysql_query("SELECT ii.pas_kec, iii.nama_kec, COUNT(*) AS kec_inap 
                                    FROM rekam_inap_masuk i
                                    INNER JOIN tbl_pasien ii ON i.in_rm = ii.pas_no_rm
                                    INNER JOIN lok_kecamatan iii ON ii.pas_kec = iii.id_kec
                                    WHERE Month(in_tgl_masuk)=$bulan && YEAR(in_tgl_masuk)=$tahun
                                    GROUP BY ii.pas_kec");
				$no = 1;

				while ($kec = mysql_fetch_assoc($kecs)) {
					echo "
					<tr valign=top>
					<td ALIGN=CENTER>$no</td>
					<td ALIGN=CENTER>".$kec['nama_kec']."</td>
					<td ALIGN=CENTER>".$kec['kec_inap']."</td>
					</tr>";

					$no++;
				}
				?>
			</table>

			<!-- end 1 -->

			<!-- start 2 -->

			<P STYLE="margin-left: 0.5in; margin-bottom: 0.11in"><BR><BR>
			</P>
			<OL START=2>
				<LI><P STYLE="margin-bottom: 0.11in"><FONT FACE="Times New Roman, serif"><FONT SIZE=3>Kesetiaan
				pasien yang berobat rawat inap bulan <?php echo $bulanID; ?> <?php echo $tahun; ?></FONT></FONT></P>
			</OL>

			<table border="1" WIDTH=575 CELLPADDING=7 CELLSPACING=0>
				
				<tr valign=top>
					<th CLASS="western" ALIGN=CENTER>NO</th>
					<th CLASS="western" ALIGN=CENTER>KECAMATAN</th>
					<th CLASS="western" ALIGN=CENTER>JUMLAH PASIEN</th>
				</tr>

				<?php
				$lamas = mysql_query("SELECT ii.pas_kec, iii.nama_kec, COUNT(*) AS kec_lama 
	                                    FROM rekam_inap_masuk i
	                                    INNER JOIN tbl_pasien ii ON i.in_rm = ii.pas_no_rm
	                                    INNER JOIN lok_kecamatan iii ON ii.pas_kec = iii.id_kec
	                                    WHERE i.in_status='0' && Month(in_tgl_masuk)=$bulan && YEAR(in_tgl_masuk)=$tahun
	                                    GROUP BY ii.pas_kec");
				$no = 1;

				while ($lama = mysql_fetch_assoc($lamas)) {
					echo "
					<tr valign=top>
					<td ALIGN=CENTER>$no</td>
					<td ALIGN=CENTER>".$lama['nama_kec']."</td>
					<td ALIGN=CENTER>".$lama['kec_lama']."</td>
					</tr>";

					$no++;
				}
				?>
			</table>

			<!-- end 2 -->

			<!-- start 3 -->

		<P STYLE="margin-left: 0.5in; margin-bottom: 0.11in"><BR><BR>
		</P>
		<OL START=3>
			<LI><P STYLE="margin-bottom: 0.11in"><FONT FACE="Times New Roman, serif"><FONT SIZE=3>Pasien
			lama dan baru rawat inap bulan <?php echo $bulanID; ?> <?php echo $tahun; ?></FONT></FONT></P>
		</OL>

		<table border="1" WIDTH=575 CELLPADDING=7 CELLSPACING=0>
			
			<tr valign=top>
				<th CLASS="western" ALIGN=CENTER>STATUS PASIEN</th>
				<th CLASS="western" ALIGN=CENTER>JUMLAH PASIEN</th>
			</tr>

			<?php

			$statuss = $this->db->query("SELECT 
                                      (SELECT COUNT(*) FROM rekam_inap_masuk WHERE in_status=1 && Month(in_tgl_masuk)=$bulan && YEAR(in_tgl_masuk)=$tahun) AS p_baru,
                                      (SELECT COUNT(*) FROM rekam_inap_masuk WHERE in_status=0 && Month(in_tgl_masuk)=$bulan && YEAR(in_tgl_masuk)=$tahun) AS p_lama");


			foreach ($statuss->result() as $status):
                  echo "<tr>"; 
                  echo "<td ALIGN=CENTER>Pasien Baru</td>";
                  echo "<td ALIGN=CENTER>$status->p_baru</td>";
                  echo "</tr>";

                  echo "<tr>"; 
                  echo "<td ALIGN=CENTER>Pasien Lama</td>";
                  echo "<td ALIGN=CENTER>$status->p_lama</td>";
                  echo "</tr>";
                endforeach;
			?>
		</table>

		<!-- end 3 -->

		<!-- start 4 -->

		<P STYLE="margin-left: 0.5in; margin-bottom: 0.11in"><BR><BR>
		</P>
		<OL START=4>
			<LI><P STYLE="margin-bottom: 0.11in"><FONT FACE="Times New Roman, serif"><FONT SIZE=3>Jenis Kedatangan Pasien yang berobat Rawat Inap Bulan <?php echo $bulanID; ?> <?php echo $tahun; ?></FONT></FONT></P>
		</OL>

		<table border="1" WIDTH=575 CELLPADDING=7 CELLSPACING=0>
			
			<tr valign=top>
				<th CLASS="western" ALIGN=CENTER>NO</th>
				<th CLASS="western" ALIGN=CENTER>JENIS KEADAAN</th>
				<th CLASS="western" ALIGN=CENTER>JUMLAH PASIEN</th>
			</tr>

			<?php
			$datangs = mysql_query("SELECT in_jen_datang, datang_detail, COUNT(*) AS status_datang FROM rekam_inap_masuk WHERE Month(in_tgl_masuk)=$bulan && YEAR(in_tgl_masuk)=$tahun GROUP BY datang_detail");
			$no = 1;

			while ($datang = mysql_fetch_assoc($datangs)) {
				echo "
				<tr valign=top>
				<td ALIGN=CENTER>$no</td>";
				echo "
				<td ALIGN=CENTER>"; 
				
				switch ($datang['datang_detail']) {
					case '1':
						echo "Datang Sendiri";
						break;

					case '2':
						echo "Poli";
						break;

					case '3':
						echo "Rujukan Dokter";
						break;

					case '4':
						echo "Rujukan Puskesmas";
						break;

					case '5':
						echo "Instansi Lain";
						break;
				}
				echo "</td>
				<td ALIGN=CENTER>".$datang['status_datang']."</td>
				</tr>";

				$no++;
			}
			?>
		</table>

		<!-- end 4 -->

		<!-- start 5 -->

		<P STYLE="margin-left: 0.5in; margin-bottom: 0.11in"><BR><BR>
		</P>
		<OL START=5>
			<LI><P STYLE="margin-bottom: 0.11in"><FONT FACE="Times New Roman, serif"><FONT SIZE=3>Keadaan Pulan PAsien Rawat Inap Bulan <?php echo $bulanID; ?> <?php echo $tahun; ?></FONT></FONT></P>
		</OL>

		<table border="1" WIDTH=575 CELLPADDING=7 CELLSPACING=0>
			
			<tr valign=top>
				<th CLASS="western" ALIGN=CENTER>NO</th>
				<th CLASS="western" ALIGN=CENTER>KEADAAN PASIEN PULAN</th>
				<th CLASS="western" ALIGN=CENTER>JUMLAH PASIEN</th>
			</tr>

			<?php
			$keadaans = mysql_query("SELECT keadaan_detail, COUNT(*) AS status_keadaan FROM rekam_inap_keluar WHERE Month(inap_tgl_keluar)=$bulan && YEAR(inap_tgl_keluar)=$tahun GROUP BY keadaan_detail");
			$no = 1;

			while ($keadaan = mysql_fetch_assoc($keadaans)) {
				echo "
				<tr valign=top>
				<td ALIGN=CENTER>$no</td>";
				echo "
				<td ALIGN=CENTER>"; 
				
				switch ($keadaan['keadaan_detail']) {
					case '1':
						echo "Sehat";
						break;

					case '2':
						echo "Pulang Sendiri";
						break;

					case '3':
						echo "Dirujuk";
						break;

					case '4':
						echo "Mati <48 Jam";
						break;

					case '5':
						echo "Mati >48 Jam";
						break;
				}
				echo "</td>
				<td ALIGN=CENTER>".$keadaan['status_keadaan']."</td>
				</tr>";

				$no++;
			}
			?>
		</table>

		<!-- end 5 -->

		<!-- start 6 -->
		<P STYLE="margin-left: 0.5in; margin-bottom: 0.11in"><BR><BR>
		</P>
		<OL START=6>
			<LI><P STYLE="margin-bottom: 0.11in"><FONT FACE="Times New Roman, serif"><FONT SIZE=3>Kunjungan
			pasien poli rawat inap bulan <?php echo $bulanID; ?> <?php echo $tahun; ?></FONT></FONT></P>
		</OL>

		<table border="1" WIDTH=575 CELLPADDING=7 CELLSPACING=0>
			
			<tr valign=top>
				<th CLASS="western" ALIGN=CENTER>NO</th>
				<th CLASS="western" ALIGN=CENTER>NAMA POLI</th>
				<th CLASS="western" ALIGN=CENTER>JUMLAH PASIEN</th>
			</tr>

			<?php
			$polis = mysql_query("SELECT ii.poli_nama, COUNT(*) AS total_poli 
                                    FROM rekam_inap_masuk i
                                    INNER JOIN poli ii ON i.in_poli = ii.poli_id
                                    WHERE Month(in_tgl_masuk)=$bulan && YEAR(in_tgl_masuk)=$tahun
                                    GROUP BY i.in_poli");
			$no = 1;

			while ($poli = mysql_fetch_assoc($polis)) {
				echo "
				<tr valign=top>
				<td ALIGN=CENTER>$no</td>
				<td ALIGN=CENTER>".$poli['poli_nama']."</td>
				<td ALIGN=CENTER>".$poli['total_poli']."</td>
				</tr>";

				$no++;
			}
			?>
		</table>
		<!-- end 6 -->

		<!-- start 7 -->
		<P STYLE="margin-left: 0.5in; margin-bottom: 0.11in"><BR><BR>
		</P>
		<OL START=7>
			<LI><P STYLE="margin-bottom: 0.11in"><FONT FACE="Times New Roman, serif"><FONT SIZE=3>10
			besar penyakit rawat inap bulan <?php echo $bulanID; ?> <?php echo $tahun; ?></FONT></FONT></P>
		</OL>

		<table border="1" WIDTH=575 CELLPADDING=7 CELLSPACING=0>
			
			<tr valign=top>
				<th CLASS="western" ALIGN=CENTER>NO</th>
				<th CLASS="western" ALIGN=CENTER>JENIS PENYAKIT</th>
				<th CLASS="western" ALIGN=CENTER>JUMLAH PASIEN</th>
			</tr>

			<?php
			$penyakits = mysql_query("SELECT i.inap_diagnosa,ii.indonesia, COUNT(*) AS total_penyakit
                                      FROM rekam_inap_keluar i
                                      INNER JOIN icd_10 ii ON i.inap_diagnosa = ii.kode_icd AND i.diagnosa_kategori = ii.categori
                                      WHERE Month(inap_tgl_keluar)=$bulan && YEAR(inap_tgl_keluar)=$tahun
                                      GROUP BY i.inap_diagnosa LIMIT 10");
			$no = 1;

			while ($penyakit = mysql_fetch_assoc($penyakits)) {
				echo "
				<tr valign=top>
				<td ALIGN=CENTER>$no</td>
				<td ALIGN=CENTER>".$penyakit['indonesia']."</td>
				<td ALIGN=CENTER>".$penyakit['total_penyakit']."</td>
				</tr>";

				$no++;
			}
			?>
		</table>
		<!-- end 7 -->

		<!-- start 8 -->
		<P STYLE="margin-left: 0.5in; margin-bottom: 0.11in"><BR><BR>
		</P>
		<OL START=8>
			<LI><P STYLE="margin-bottom: 0.11in"><FONT FACE="Times New Roman, serif"><FONT SIZE=3>Jenis
			pembayaran pasien rawat inap bulan <?php echo $bulanID; ?> <?php echo $tahun; ?></FONT></FONT></P>
		</OL>

		<table border="1" WIDTH=575 CELLPADDING=7 CELLSPACING=0>
			
			<tr valign=top>
				<th CLASS="western" ALIGN=CENTER>NO</th>
				<th CLASS="western" ALIGN=CENTER>JENIS PEMBAYARAN</th>
				<th CLASS="western" ALIGN=CENTER>DETAIL PEMBAYARAN</th>
				<th CLASS="western" ALIGN=CENTER>JUMLAH PASIEN</th>
			</tr>

			<?php
			$bayars = mysql_query("SELECT ii.bay_nama,iii.bay_det_nama, COUNT(*) AS total_biaya
                                    FROM rekam_inap_masuk i
                                    INNER JOIN pembayaran ii ON i.in_bayar = ii.bay_id
                                    INNER JOIN bayar_detail iii ON i.in_bayar_detail = iii.bay_det_id
                                    WHERE Month(in_tgl_masuk)=$bulan && YEAR(in_tgl_masuk)=$tahun
                                    GROUP BY i.in_bayar_detail");
			$no = 1;

			while ($bayar = mysql_fetch_assoc($bayars)) {
				echo "
				<tr valign=top>
				<td ALIGN=CENTER>$no</td>
				<td ALIGN=CENTER>".$bayar['bay_nama']."</td>
				<td ALIGN=CENTER>".$bayar['bay_det_nama']."</td>
				<td ALIGN=CENTER>".$bayar['total_biaya']."</td>
				</tr>";

				$no++;
			}
			?>
		</table>

		<!-- end 8 -->

		<!-- start 9 -->
		<P STYLE="margin-left: 0.5in; margin-bottom: 0.11in"><BR><BR>
		</P>
		<OL START=9>
			<LI><P STYLE="margin-bottom: 0.11in"><FONT FACE="Times New Roman, serif"><FONT SIZE=3>Kunjungan Dokter Pasien Rawat Inap Bulan <?php echo $bulanID; ?> <?php echo $tahun; ?></FONT></FONT></P>
		</OL>

		<table border="1" WIDTH=575 CELLPADDING=7 CELLSPACING=0>
			
			<tr valign=top>
				<th CLASS="western" ALIGN=CENTER>NO</th>
				<th CLASS="western" ALIGN=CENTER>NAMA DOKTER</th>
				<th CLASS="western" ALIGN=CENTER>JUMLAH KUNJUNGAN</th>
			</tr>

			<?php
			$dokters = mysql_query("SELECT ii.dokter_nama, COUNT(*) AS total_dokter
                                    FROM rekam_inap_masuk i
                                    INNER JOIN dokter ii ON i.in_dokter = ii.dokter_id
                                    WHERE Month(in_tgl_masuk)=$bulan && YEAR(in_tgl_masuk)=$tahun
                                    GROUP BY i.in_dokter");
			$no = 1;

			while ($dokter = mysql_fetch_assoc($dokters)) {
				echo "
				<tr valign=top>
				<td ALIGN=CENTER>$no</td>
				<td ALIGN=CENTER>".$dokter['dokter_nama']."</td>
				<td ALIGN=CENTER>".$dokter['total_dokter']."</td>
				</tr>";

				$no++;
			}
			?>
		</table>

		<!-- end 9 -->

		<!-- start 10 -->
		<P STYLE="margin-left: 0.5in; margin-bottom: 0.11in"><BR><BR>
		</P>
		<OL START=10>
			<LI><P STYLE="margin-bottom: 0.11in"><FONT FACE="Times New Roman, serif"><FONT SIZE=3>AKLPCM Bulan <?php echo $bulanID; ?> <?php echo $tahun; ?></FONT></FONT></P>
		</OL>

		<table border="1" WIDTH=575 CELLPADDING=7 CELLSPACING=0>
			
			<tr valign=top>
				<th CLASS="western" ALIGN=CENTER>NO</th>
				<th CLASS="western" ALIGN=CENTER>JENIS AKLPCM</th>
				<th CLASS="western" ALIGN=CENTER>LENGKAP</th>
				<th CLASS="western" ALIGN=CENTER>TIDAK LENGKAP</th>
			</tr>

			<?php

			$statuss = $this->db->query("SELECT 
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_tpip=0 && Month(inap_tgl_keluar)=$bulan && YEAR(inap_tgl_keluar)=$tahun) AS tpip_lp,
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_igd=0 && Month(inap_tgl_keluar)=$bulan && YEAR(inap_tgl_keluar)=$tahun) AS igd_lp,
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_kamar=0 && Month(inap_tgl_keluar)=$bulan && YEAR(inap_tgl_keluar)=$tahun) AS kamar_lp,
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_ok=0 && Month(inap_tgl_keluar)=$bulan && YEAR(inap_tgl_keluar)=$tahun) AS ok_lp,
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_gizi=0 && Month(inap_tgl_keluar)=$bulan && YEAR(inap_tgl_keluar)=$tahun) AS gizi_lp,
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_farmasi=0 && Month(inap_tgl_keluar)=$bulan && YEAR(inap_tgl_keluar)=$tahun) AS farmasi_lp,
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_tpip=1 && Month(inap_tgl_keluar)=$bulan && YEAR(inap_tgl_keluar)=$tahun) AS tpip_tp,
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_igd=1 && Month(inap_tgl_keluar)=$bulan && YEAR(inap_tgl_keluar)=$tahun) AS igd_tp,
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_kamar=1 && Month(inap_tgl_keluar)=$bulan && YEAR(inap_tgl_keluar)=$tahun) AS kamar_tp,
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_ok=1 && Month(inap_tgl_keluar)=$bulan && YEAR(inap_tgl_keluar)=$tahun) AS ok_tp,
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_gizi=1 && Month(inap_tgl_keluar)=$bulan && YEAR(inap_tgl_keluar)=$tahun) AS gizi_tp,
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_farmasi=1 && Month(inap_tgl_keluar)=$bulan && YEAR(inap_tgl_keluar)=$tahun) AS farmasi_tp");


			foreach ($statuss->result() as $status):
                  echo "<tr>"; 
                  echo "<td ALIGN=CENTER>1.</td>";              
                  echo "<td ALIGN=CENTER>TPIP</td>";
                  echo "<td ALIGN=CENTER>$status->tpip_lp</td>";
                  echo "<td ALIGN=CENTER>$status->tpip_tp</td>";
                  echo "</tr>";

                  echo "<tr>"; 
                  echo "<td ALIGN=CENTER>2.</td>";              
                  echo "<td ALIGN=CENTER>IGD</td>";
                  echo "<td ALIGN=CENTER>$status->igd_lp</td>";
                  echo "<td ALIGN=CENTER>$status->igd_tp</td>";
                  echo "</tr>";

                  echo "<tr>"; 
                  echo "<td ALIGN=CENTER>3.</td>";              
                  echo "<td ALIGN=CENTER>KAMAR</td>";
                  echo "<td ALIGN=CENTER>$status->kamar_lp</td>";
                  echo "<td ALIGN=CENTER>$status->kamar_tp</td>";
                  echo "</tr>";

                  echo "<tr>"; 
                  echo "<td ALIGN=CENTER>4.</td>";              
                  echo "<td ALIGN=CENTER>OK</td>";
                  echo "<td ALIGN=CENTER>$status->ok_lp</td>";
                  echo "<td ALIGN=CENTER>$status->ok_tp</td>";
                  echo "</tr>";

                  echo "<tr>"; 
                  echo "<td ALIGN=CENTER>5.</td>";              
                  echo "<td ALIGN=CENTER>GIZI</td>";
                  echo "<td ALIGN=CENTER>$status->gizi_lp</td>";
                  echo "<td ALIGN=CENTER>$status->gizi_tp</td>";
                  echo "</tr>";

                  echo "<tr>"; 
                  echo "<td ALIGN=CENTER>6.</td>";              
                  echo "<td ALIGN=CENTER>FARMASI</td>";
                  echo "<td ALIGN=CENTER>$status->farmasi_lp</td>";
                  echo "<td ALIGN=CENTER>$status->farmasi_tp</td>";
                  echo "</tr>";
                endforeach;
			?>
		</table>

		<!-- end 10 -->

		<!-- start 11 -->

		<P STYLE="margin-left: 0.5in; margin-bottom: 0.11in"><BR><BR>
		</P>
		<OL START=11>
			<LI><P STYLE="margin-bottom: 0.11in"><FONT FACE="Times New Roman, serif"><FONT SIZE=3>AKLPCM Informed Consent Bulan <?php echo $bulanID; ?> <?php echo $tahun; ?></FONT></FONT></P>
		</OL>

		<table border="1" WIDTH=575 CELLPADDING=7 CELLSPACING=0>
			
			<tr valign=top>
				<th CLASS="western" ALIGN=CENTER>STATUS KELENGKAPAN</th>
				<th CLASS="western" ALIGN=CENTER>JUMLAH PASIEN</th>
			</tr>

			<?php

			$statuss = $this->db->query("SELECT 
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_setuju=0 && Month(inap_tgl_keluar)=$bulan && YEAR(inap_tgl_keluar)=$tahun) AS lengkap,
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_setuju=1 && Month(inap_tgl_keluar)=$bulan && YEAR(inap_tgl_keluar)=$tahun) AS tidak_lengkap");


			foreach ($statuss->result() as $status):
                  echo "<tr>"; 
                  echo "<td ALIGN=CENTER>Lengkap</td>";
                  echo "<td ALIGN=CENTER>$status->lengkap</td>";
                  echo "</tr>";

                  echo "<tr>"; 
                  echo "<td ALIGN=CENTER>Tidak Lengkap</td>";
                  echo "<td ALIGN=CENTER>$status->tidak_lengkap</td>";
                  echo "</tr>";
                endforeach;
			?>
		</table>

		<!-- end 11 -->

		<!-- start 12 -->

		<P STYLE="margin-left: 0.5in; margin-bottom: 0.11in"><BR><BR>
		</P>
		<OL START=12>
			<LI><P STYLE="margin-bottom: 0.11in"><FONT FACE="Times New Roman, serif"><FONT SIZE=3>KLPCM Bulan <?php echo $bulanID; ?> <?php echo $tahun; ?></FONT></FONT></P>
		</OL>

		<table border="1" WIDTH=575 CELLPADDING=7 CELLSPACING=0>
			
			<tr valign=top>
				<th CLASS="western" ALIGN=CENTER>STATUS KELENGKAPAN</th>
				<th CLASS="western" ALIGN=CENTER>JUMLAH PASIEN</th>
			</tr>

			<?php

			$statuss = $this->db->query("SELECT 
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_tpip=0 && Month(inap_tgl_keluar)=$bulan && YEAR(inap_tgl_keluar)=$tahun)+
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_igd=0 && Month(inap_tgl_keluar)=$bulan && YEAR(inap_tgl_keluar)=$tahun)+
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_kamar=0 && Month(inap_tgl_keluar)=$bulan && YEAR(inap_tgl_keluar)=$tahun)+
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_ok=0 && Month(inap_tgl_keluar)=$bulan && YEAR(inap_tgl_keluar)=$tahun)+
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_gizi=0 && Month(inap_tgl_keluar)=$bulan && YEAR(inap_tgl_keluar)=$tahun)+
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_farmasi=0 && Month(inap_tgl_keluar)=$bulan && YEAR(inap_tgl_keluar)=$tahun) AS lengkap, 
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_tpip=1 && Month(inap_tgl_keluar)=$bulan && YEAR(inap_tgl_keluar)=$tahun)+
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_igd=1 && Month(inap_tgl_keluar)=$bulan && YEAR(inap_tgl_keluar)=$tahun)+
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_kamar=1 && Month(inap_tgl_keluar)=$bulan && YEAR(inap_tgl_keluar)=$tahun)+
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_ok=1 && Month(inap_tgl_keluar)=$bulan && YEAR(inap_tgl_keluar)=$tahun)+
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_gizi=1 && Month(inap_tgl_keluar)=$bulan && YEAR(inap_tgl_keluar)=$tahun)+
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_farmasi=1 && Month(inap_tgl_keluar)=$bulan && YEAR(inap_tgl_keluar)=$tahun) AS tidak_lengkap");


			foreach ($statuss->result() as $status):
                  echo "<tr>"; 
                  echo "<td ALIGN=CENTER>Lengkap</td>";
                  echo "<td ALIGN=CENTER>$status->lengkap</td>";
                  echo "</tr>";

                  echo "<tr>"; 
                  echo "<td ALIGN=CENTER>Tidak Lengkap</td>";
                  echo "<td ALIGN=CENTER>$status->tidak_lengkap</td>";
                  echo "</tr>";
                endforeach;
			?>
		</table>

		<!-- end 12 -->

		<!-- start 13 -->
		<P STYLE="margin-left: 0.5in; margin-bottom: 0.11in"><BR><BR>
		</P>
		<OL START=13>
			<LI><P STYLE="margin-bottom: 0.11in"><FONT FACE="Times New Roman, serif"><FONT SIZE=3>Jumlah BOR, LOS, TOI HARI PERAWATAN, Bulan <?php echo $bulanID; ?> <?php echo $tahun; ?></FONT></FONT></P>
		</OL>

		<table border="1" WIDTH=575 CELLPADDING=7 CELLSPACING=0>
			
			<tr valign=top>
				<th CLASS="western" ALIGN=CENTER>PASIEN AWAL</th>
				<th CLASS="western" ALIGN=CENTER>PASIEN KELUAR</th>
				<th CLASS="western" ALIGN=CENTER>SISA PASIEN</th>
				<th CLASS="western" ALIGN=CENTER>HARI PRWTN</th>
				<th CLASS="western" ALIGN=CENTER>LAMA DRWT</th>
				<th CLASS="western" ALIGN=CENTER>TT</th>
				<th CLASS="western" ALIGN=CENTER>PERIODE</th>
				<th CLASS="western" ALIGN=CENTER>BOR %</th>
				<th CLASS="western" ALIGN=CENTER>ALOS (HR)</th>
				<th CLASS="western" ALIGN=CENTER>TOI (HR)</th>
				<th CLASS="western" ALIGN=CENTER>BTO X</th>
				<th CLASS="western" ALIGN=CENTER>NDR</th>
				<th CLASS="western" ALIGN=CENTER>GDR</th>
			</tr>

			<?php
			$bors = mysql_query("SELECT * FROM hitung_rm WHERE Month(hitung_date)=$bulan && YEAR(hitung_date)=$tahun");
			
			while ($bor = mysql_fetch_assoc($bors)) {
				echo "
				<tr valign=top>
				<td ALIGN=CENTER>".$bor['hitung_pas_awal']."</td>
				<td ALIGN=CENTER>".$bor['hitung_pas_keluar']."</td>
				<td ALIGN=CENTER>".$bor['hitung_pas_sisa']."</td>
				<td ALIGN=CENTER>".$bor['hitung_hr_rawat']."</td>
				<td ALIGN=CENTER>".$bor['hitung_lm_rawat']."</td>
				<td ALIGN=CENTER>".$bor['hitung_tt']."</td>
				<td ALIGN=CENTER>".$bor['hitung_periode']."</td>
				<td ALIGN=CENTER>".$bor['hitung_bor']."</td>
				<td ALIGN=CENTER>".$bor['hitung_alos']."</td>
				<td ALIGN=CENTER>".$bor['hitung_toi']."</td>
				<td ALIGN=CENTER>".$bor['hitung_bto']."</td>
				<td ALIGN=CENTER>".$bor['hitung_ndr']."</td>
				<td ALIGN=CENTER>".$bor['hitung_gdr']."</td>
				</tr>";
			}
			?>
		</table>

		<!-- end 13 -->

		<!-- start 14 -->
		<P STYLE="margin-left: 0.5in; margin-bottom: 0.11in"><BR><BR>
		</P>
		<OL START=14>
			<LI><P STYLE="margin-bottom: 0.11in"><FONT FACE="Times New Roman, serif"><FONT SIZE=3>Jumlah BOR, LOS, TOI Per Ruangan Bulan <?php echo $bulanID; ?> <?php echo $tahun; ?></FONT></FONT></P>
		</OL>

		<table border="1" WIDTH=575 CELLPADDING=7 CELLSPACING=0>
			
			<tr valign=top>
				<th CLASS="western" ALIGN=CENTER>KAMAR</th>
				<th CLASS="western" ALIGN=CENTER>PASIEN AWAL</th>
				<th CLASS="western" ALIGN=CENTER>PASIEN KELUAR</th>
				<th CLASS="western" ALIGN=CENTER>SISA PASIEN</th>
				<th CLASS="western" ALIGN=CENTER>HARI PRWTN</th>
				<th CLASS="western" ALIGN=CENTER>LAMA DRWT</th>
				<th CLASS="western" ALIGN=CENTER>TT</th>
				<th CLASS="western" ALIGN=CENTER>PERIODE</th>
				<th CLASS="western" ALIGN=CENTER>BOR %</th>
				<th CLASS="western" ALIGN=CENTER>ALOS (HR)</th>
				<th CLASS="western" ALIGN=CENTER>TOI (HR)</th>
				<th CLASS="western" ALIGN=CENTER>BTO X</th>
				<th CLASS="western" ALIGN=CENTER>NDR</th>
				<th CLASS="western" ALIGN=CENTER>GDR</th>
			</tr>

			<?php
			$bors = mysql_query("SELECT i.h_kmr_kamar, i.h_kmr_awal, i.h_kmr_keluar, i.h_kmr_sisa, i.h_kmr_hr, i.h_kmr_lm,
                                  i.h_kmr_tt, i.h_kmr_periode, i.h_kmr_bor, i.h_kmr_alos, i.h_kmr_toi, i.h_kmr_bto, i.h_kmr_ndr,
                                  i.h_kmr_gdr, ii.kmr_d_nama
                                  FROM hitung_kmr i
                                  INNER JOIN kamar_detail ii ON i.h_kmr_kamar = ii.kmr_d_id
                                  WHERE Month(i.h_kmr_date)=$bulan && YEAR(i.h_kmr_date)=$tahun");
			
			while ($bor = mysql_fetch_assoc($bors)) {
				echo "
				<tr valign=top>
				<td ALIGN=CENTER>".$bor['kmr_d_nama']."</td>
				<td ALIGN=CENTER>".$bor['h_kmr_awal']."</td>
				<td ALIGN=CENTER>".$bor['h_kmr_keluar']."</td>
				<td ALIGN=CENTER>".$bor['h_kmr_sisa']."</td>
				<td ALIGN=CENTER>".$bor['h_kmr_hr']."</td>
				<td ALIGN=CENTER>".$bor['h_kmr_lm']."</td>
				<td ALIGN=CENTER>".$bor['h_kmr_tt']."</td>
				<td ALIGN=CENTER>".$bor['h_kmr_periode']."</td>
				<td ALIGN=CENTER>".$bor['h_kmr_bor']."</td>
				<td ALIGN=CENTER>".$bor['h_kmr_alos']."</td>
				<td ALIGN=CENTER>".$bor['h_kmr_toi']."</td>
				<td ALIGN=CENTER>".$bor['h_kmr_bto']."</td>
				<td ALIGN=CENTER>".$bor['h_kmr_ndr']."</td>
				<td ALIGN=CENTER>".$bor['h_kmr_gdr']."</td>
				</tr>";
			}
			?>
		</table>

		<!-- end 14 -->		

	</div>
	
</body>
</html>