var Script = function () {

    $().ready(function() {
        // validate the comment form when it is submitted
        $("#feedback_form").validate();

        // validate poli
        $("#register_form_dokter").validate({
            rules: {
                poli: {
                    required: true,
                    minlength: 1
                },
                nama: {
                    required: true,
                    minlength: 1
                }
            },
            messages: {
                poli: {
                    required: "Nama poli harus dipilih."
                },                
                nama: {
                    required: "Nama poli tidak boleh kosong.",
                    minlength: "Minimal 1 karakter."
                }
            }
        });

        // validate poli
        $("#register_form_poli").validate({
            rules: {
                nama: {
                    required: true,
                    minlength: 1
                }
            },
            messages: {                
                nama: {
                    required: "Nama poli tidak boleh kosong.",
                    minlength: "Minimal 1 karakter."
                }
            }
        });

        // validate register rawat jalan
        $("#register_form_reg_rj").validate({
            rules: {
                no_rm: {
                    required: true,
                    minlength: 6
                },
                status: {
                    required: true,
                    minlength: 1
                },
                nama: {
                    required: true,
                    minlength: 1
                },
                jenkel: {
                    required: true,
                    minlength: 1
                },
                kabupatent: {
                    required: true,
                    minlength: 1
                },
                kecamatant: {
                    required: true,
                    minlength: 1
                },
                desat: {
                    required: true,
                    minlength: 1
                },
                rt: {
                    required: true,
                    minlength: 2
                },
                rw: {
                    required: true,
                    minlength: 2
                },
                poli: {
                    required: true,
                    minlength: 1
                },
                dokter: {
                    required: true,
                    minlength: 1
                },
                bayar: {
                    required: true,
                    minlength: 1
                },
                detbayar: {
                    required: true,
                    minlength: 1
                }
            },
            messages: {                
                no_rm: {
                    required: "Nomer Rekam Medis tidak boleh kosong.",
                    minlength: "Minimal 6 karakter."
                },
                status: {
                    required: "Status pasien belum dipilih."
                },                
                nama: {
                    required: "Nama pasien tidak boleh kosong.",
                    minlength: "Minimal 1 karakter."
                },
                jenkel: {
                    required: "Jenis kelamin pasien belum dipilih."
                },                
                kabupaten: {
                    required: "Kabupaten belum dipilih."
                },                
                kecamatan: {
                    required: "Kecamatan belum dipilih."
                },                
                desa: {
                    required: "Desa belum dipilih."
                },                
                rt: {
                    required: "RT tidak boleh kosong.",
                    minlength: "Minimal 2 angka."
                },                
                rw: {
                    required: "RW tidak boleh kosong.",
                    minlength: "Minimal 2 angka."
                },                
                poli: {
                    required: "Poli belum dipilih."
                },                
                dokter: {
                    required: "Dokter belum dipilih."
                },                
                bayar: {
                    required: "Pembayaran belum dipilih."
                },                
                detbayar: {
                    required: "Detail pembayaran belum dipilih."
                }
            }
        });
// validate register rawat inap
        $("#register_form_reg_ri").validate({
            rules: {
                no_rm: {
                    required: true,
                    minlength: 6
                },
                nama: {
                    required: true,
                    minlength: 1
                },
                jenkel: {
                    required: true,
                    minlength: 1
                },
                rt: {
                    required: true,
                    minlength: 2
                },
                rw: {
                    required: true,
                    minlength: 2
                },
                tgl_lahir: {
                    required: true,
                    minlength: 10
                },
                tgl_masuk: {
                    required: true,
                    minlength: 10
                }
            },
            messages: {                
                no_rm: {
                    required: "Nomer Rekam Medis tidak boleh kosong.",
                    minlength: "Minimal 6 karakter."
                },
                status: {
                    required: "Status pasien belum dipilih."
                },                
                nama: {
                    required: "Nama pasien tidak boleh kosong.",
                    minlength: "Minimal 1 karakter."
                },
                jenkel: {
                    required: "Jenis kelamin pasien belum dipilih."
                },                
                rt: {
                    required: "RT tidak boleh kosong.",
                    minlength: "Minimal 2 angka."
                },                
                rw: {
                    required: "RW tidak boleh kosong.",
                    minlength: "Minimal 2 angka."
                },                
                tgl_lahir: {
                    required: "Tanggal Lahir tidak boleh kosong.",
                    minlength: "Masukan tanggal lahir yang benar."
                },                
                tgl_masuk: {
                    required: "Tanggal Masuk tidak boleh kosong.",
                    minlength: "Masukan tanggal masuk yang benar."
                }
            }
        });

        // validate register rawat jalan
        $("#register_form_rm_rj").validate({
            rules: {
                tgl_keluar: {
                    required: true,
                    minlength: 10
                },
                indonesia: {
                    required: true
                }
            },
            messages: {                
                tgl_keluar: {
                    required: "Tanggal keluar tidak boleh kosong.",
                    minlength: "Masukan tanggal keluar yang benar."
                },
                indonesia: {
                    required: "Diagnosa belum dipilih."
                }
            }
        });

        // validate register rawat inap
        $("#register_form_rm_ri").validate({
            rules: {
                tgl_keluar: {
                    required: true,
                    minlength: 10
                },
                indonesia: {
                    required: true
                }
            },
            messages: {                
                tgl_keluar: {
                    required: "Tanggal keluar tidak boleh kosong.",
                    minlength: "Masukan tanggal keluar yang benar."
                },
                indonesia: {
                    required: "Diagnosa belum dipilih."
                }
            }
        });

    });


}();