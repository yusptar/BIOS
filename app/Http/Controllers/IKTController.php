<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IKTController extends Controller
{
    // Auth
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function visite_psn_10()
    {
        return view('ikt.visite_psn_10');
    }

    public function visite_psn_10_12()
    {
        return view('ikt.visite_psn_10-12');
    }

    public function visite_psn_12()
    {
        return view('ikt.visite_psn_12');
    }

    public function dpjp_tidak_visite()
    {
        return view('ikt.dpjp_non_visite');
    }

    public function kegiatan_visite_pasien_pertama()
    {
        return view('ikt.visite_psn_pertama');
    }

    public function rasio_pobo()
    {
        return view('ikt.rasio_pobo');
    }

    public function pertumbuhan_realisasi_pendapatan_dari_pengelolaan_asetBLU()
    {
        return view('ikt.pendapatan_pengelolaan_blu');
    }

    public function penyelenggara_rekam_medis_elektronik()
    {
        return view('ikt.rkm_medis_elektronik');
    }

    public function kepatuhan_pelaksanaan_protokol_kesehatan()
    {
        return view('ikt.kpthn_protokol_kesehatan');
    }

    public function presentase_pembelian_alat_kesehatan_produksi_dalam_negeri()
    {
        return view('ikt.pmblian_alat_produksi');
    }

    public function kepuasan_pasien()
    {
        return view('ikt.kepuasan_pasien');
    }

    public function kepatuhan_waktu_visite_dpjp()
    {
        return view('ikt.kpthn_visite_dpjp');
    }

    public function kemampuan_menangani_bblsr_1500g()
    {
        return view('ikt.bblsr_1500');
    }

    public function keberhasilan_tindakan_bedah_jantung_cabg_dan_tof()
    {
        return view('ikt.tndkn_cabg_tof');
    }

    public function penyelenggaraan_layanan_kesehatan_jiwa_safewards_who()
    {
        return view('ikt.layanan_kshtn_jiwa_who');
    }

    public function penyelenggaraan_layanan_napza__safewards_who()
    {
        return view('ikt.layanan_napza_who');
    }

    public function proporsi_pasien_tb_mdr_khusus_rs()
    {
        return view('ikt.proporsi_psn_tb_mdr_rs');
    }

    public function progresivitas_retinopati_diabetika()
    {
        return view('ikt.pasca_retinopati_diabetika');
    }

    public function persentase_pengulangan_pemeriksaan_biometri_katarak()
    {
        return view('ikt.biometri_katarak');
    }

    public function persentase_kasus_ilo_bedah_ortho()
    {
        return view('ikt.kasus_ilo_ortho');
    }

    public function door_to_needle()
    {
        return view('ikt.door_to_needle');
    }

    public function masa_tunggu_operasi_ca_mamae()
    {
        return view('ikt.masa_tunggu_ca_mammae');
    }

    public function pelayanan_rehab_medik_respiratori()
    {
        return view('ikt.plyn_rehab_medik');
    }

    public function terlaksananya_program_kesehatan_paru()
    {
        return view('ikt.trlksn_program_kesehatan_paru');
    }

    public function prosentase_tersusun_dan_terimplementasi()
    {
        return view('ikt.prsnts_implement_program');
    }

    public function proporsi_pasien_tb_mdr_khusus_bbkpm()
    {
        return view('ikt.proporsi_psn_tb_mdr_bbkpm');
    }

    public function waktu_pelayanan_pemeriksaan_lab_covid19()
    {
        return view('ikt.wkt_plyn_lab_covid-19');
    }

    public function tingkat_kepesertaan_penyelenggaraan_pme()
    {
        return view('ikt.tingkat_pme'); 
    }
    
    public function penyelenggaraan_sistem_informasi_balkes()
    {
        return view('ikt.sistem_info_balai_kesehatan');
    }

    public function kepatuhan_kebersihan_tangan()
    {
        return view('ikt.kpthn_kbrshn_tgn');
    }

    public function kepatuhan_penggunaan_apd()
    {
        return view('ikt.kpthn_penggunaan_apd');
    }

    public function kepatuhan_identifikasi_pasien()
    {
        return view('ikt.kpthn_identifikasi_psn');
    }

    public function waktu_tanggap_operasi_seksio_sesarea_emergensi()
    {
        return view('ikt.wkt_tanggap_operasi_seksio');
    }

    public function waktu_tunggu_rawat_jalan()
    {
        return view('ikt.wkt_tunggu_rawat_jalan');
    }

    public function penundaan_operasi_elektif()
    {
        return view('ikt.penundaan_operasi');
    }

    public function kepatuhan_waktu_visite_dokter()
    {
        return view('ikt.kpthn_wkt_visite');
    }

    public function pelaporan_hasil_kritis_lab()
    {
        return view('ikt.plporan_hasil_kritis_lab');
    }

    public function kepatuhan_penggunaan_formularium_nasional()
    {
        return view('ikt.kpthn_penggunaan_formularium_nasional');
    }

    public function kepatuhan_terhadap_alur_klinis()
    {
        return view('ikt.kpthn_alur_klinis');
    }

    public function kepatuhan_upaya_pencegahan_resiko_pasien_jatuh()
    {
        return view('ikt.kpthn_upaya_pencegahan_resiko_psn_jatuh');
    }

    public function kecepatan_waktu_tanggap_komplain()
    {
        return view('ikt.kcptn_wkt_tanggap');
    }

    public function indikator_pelayanan_mcu_pelaut()
    {
        return view('ikt.indikator_plyn_mcu_pelaut');
    }

    public function indikator_pelayanan_penilikan_kesling_kerja_pelayaran()
    {
        return view('ikt.indikator_plyn_penilikan_kesling_kerja_pelayaran');
    }

    public function indikator_penyediaan_dokumen_kesehatan_pelaut()
    {
        return view('ikt.indikator_penyediaan_dokumen_kesehatan_pelaut');
    }
}