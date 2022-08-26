<?php
	header("Content-Type: application/vnd.ms-word");
	header("Expires: 0");
	header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
	header("Content-disposition: attachment; filename=laporan_rawat_jalan.doc");
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
			RAWAT JALAN</B></FONT></FONT></P>
			<P ALIGN=CENTER STYLE="margin-bottom: 0.11in"><BR><BR>
			</P>

			<!-- start 1 -->

			<OL START=1>
				<LI><P STYLE="margin-bottom: 0.11in"><FONT FACE="Times New Roman, serif"><FONT SIZE=3>Asal
				pasien (kecamatan) yang berobat rawat jalan bulan <?php echo $bulanID; ?> <?php echo $tahun; ?></FONT></FONT></P>
			</OL>


		<table border="1" WIDTH=575 CELLPADDING=7 CELLSPACING=0>
			
			<tr valign=top>
				<th CLASS="western" ALIGN=CENTER>NO</th>
				<th CLASS="western" ALIGN=CENTER>KECAMATAN</th>
				<th CLASS="western" ALIGN=CENTER>JUMLAH PASIEN</th>
			</tr>

			<?php

			$kecs = mysql_query("SELECT ii.pas_kec,iii.nama_kec, COUNT(*) AS kec_jalan 
                                    FROM rekam_jalan i
                                    INNER JOIN tbl_pasien ii ON i.jln_no_rm = ii.pas_no_rm
                                    INNER JOIN lok_kecamatan iii ON ii.pas_kec = iii.id_kec
                                    WHERE Month(jln_tgl_masuk)=$bulan && YEAR(jln_tgl_masuk)=$tahun
                                    GROUP BY ii.pas_kec");
			$no = 1;

			while ($kec = mysql_fetch_assoc($kecs)) {
				echo "
				<tr valign=top>
				<td ALIGN=CENTER>$no</td>
				<td ALIGN=CENTER>".$kec['nama_kec']."</td>
				<td ALIGN=CENTER>".$kec['kec_jalan']."</td>
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
			pasien yang berobat rawat jalan bulan <?php echo $bulanID; ?> <?php echo $tahun; ?></FONT></FONT></P>
		</OL>

		<table border="1" WIDTH=575 CELLPADDING=7 CELLSPACING=0>
			
			<tr valign=top>
				<th CLASS="western" ALIGN=CENTER>NO</th>
				<th CLASS="western" ALIGN=CENTER>KECAMATAN</th>
				<th CLASS="western" ALIGN=CENTER>JUMLAH PASIEN</th>
			</tr>

			<?php
			$lamas = mysql_query("SELECT ii.pas_kec,iii.nama_kec, COUNT(*) AS kec_lama 
                                    FROM rekam_jalan i
                                    INNER JOIN tbl_pasien ii ON i.jln_no_rm = ii.pas_no_rm
                                    INNER JOIN lok_kecamatan iii ON ii.pas_kec = iii.id_kec
                                    WHERE i.jln_status='0' && Month(jln_tgl_masuk)=$bulan && YEAR(jln_tgl_masuk)=$tahun
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
			lama dan baru rawat jalan bulan <?php echo $bulanID; ?> <?php echo $tahun; ?></FONT></FONT></P>
		</OL>

		<table border="1" WIDTH=575 CELLPADDING=7 CELLSPACING=0>
			
			<tr valign=top>
				<th CLASS="western" ALIGN=CENTER>STATUS PASIEN</th>
				<th CLASS="western" ALIGN=CENTER>JUMLAH PASIEN</th>
			</tr>

			<?php

			$statuss = $this->db->query("SELECT 
                                      (SELECT COUNT(*) FROM rekam_jalan WHERE jln_status=1 && Month(jln_tgl_masuk)=$bulan && YEAR(jln_tgl_masuk)=$tahun) AS p_baru,
                                      (SELECT COUNT(*) FROM rekam_jalan WHERE jln_status=0 && Month(jln_tgl_masuk)=$bulan && YEAR(jln_tgl_masuk)=$tahun) AS p_lama");


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
			<LI><P STYLE="margin-bottom: 0.11in"><FONT FACE="Times New Roman, serif"><FONT SIZE=3>Kunjungan
			pasien poli rawat jalan bulan <?php echo $bulanID; ?> <?php echo $tahun; ?></FONT></FONT></P>
		</OL>

		<table border="1" WIDTH=575 CELLPADDING=7 CELLSPACING=0>
			
			<tr valign=top>
				<th CLASS="western" ALIGN=CENTER>NO</th>
				<th CLASS="western" ALIGN=CENTER>NAMA POLI</th>
				<th CLASS="western" ALIGN=CENTER>JUMLAH PASIEN</th>
			</tr>

			<?php
			$polis = mysql_query("SELECT ii.poli_nama, COUNT(*) AS total_poli 
                                    FROM rekam_jalan i
                                    INNER JOIN poli ii ON i.jln_poli = ii.poli_id
                                    WHERE Month(jln_tgl_masuk)=$bulan && YEAR(jln_tgl_masuk)=$tahun
                                    GROUP BY jln_poli");
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
		<!-- end 4 -->

		<!-- start 5 -->
		<P STYLE="margin-left: 0.5in; margin-bottom: 0.11in"><BR><BR>
		</P>
		<OL START=5>
			<LI><P STYLE="margin-bottom: 0.11in"><FONT FACE="Times New Roman, serif"><FONT SIZE=3>10
			besar penyakit rawat jalan bulan <?php echo $bulanID; ?> <?php echo $tahun; ?></FONT></FONT></P>
		</OL>

		<table border="1" WIDTH=575 CELLPADDING=7 CELLSPACING=0>
			
			<tr valign=top>
				<th CLASS="western" ALIGN=CENTER>NO</th>
				<th CLASS="western" ALIGN=CENTER>JENIS PENYAKIT</th>
				<th CLASS="western" ALIGN=CENTER>JUMLAH PASIEN</th>
			</tr>

			<?php
			$penyakits = mysql_query("SELECT i.jln_diagnosa,ii.indonesia, COUNT(*) AS total_penyakit
                                      FROM rekam_jalan i
                                      INNER JOIN icd_10 ii ON i.jln_diagnosa = ii.kode_icd AND i.jln_categori = ii.categori
                                      WHERE Month(jln_tgl_masuk)=$bulan && YEAR(jln_tgl_masuk)=$tahun
                                      GROUP BY i.jln_diagnosa LIMIT 10");
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
		<!-- end 5 -->

		<!-- start 6 -->
		<P STYLE="margin-left: 0.5in; margin-bottom: 0.11in"><BR><BR>
		</P>
		<OL START=6>
			<LI><P STYLE="margin-bottom: 0.11in"><FONT FACE="Times New Roman, serif"><FONT SIZE=3>Jenis
			pembayaran pasien rawat jalan bulan <?php echo $bulanID; ?> <?php echo $tahun; ?></FONT></FONT></P>
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
                                    FROM rekam_jalan i
                                    INNER JOIN pembayaran ii ON i.jln_biaya = ii.bay_id
                                    INNER JOIN bayar_detail iii ON i.biaya_detail = iii.bay_det_id
                                    WHERE Month(jln_tgl_masuk)=$bulan && YEAR(jln_tgl_masuk)=$tahun
                                    GROUP BY i.biaya_detail");
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

	</div>
	
</body>
</html>