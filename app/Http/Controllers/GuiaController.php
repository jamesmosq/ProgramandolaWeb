<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class GuiaController extends Controller
{
    private array $archivosPermitidos = [
        'guias'    => ['guia_sql_mysql','guia_php','guia_laravel','guia_laravel13','guia_moonshine','guia_moonshine4','guia_bootstrap','guia_flutter','guia_flet'],
        'talleres' => ['taller_01_bases_de_datos','taller_02_php_puro','taller_03_html_css','taller_04_laravel','taller_05_moonshine'],
    ];

    public function guia(string $nombre): Response
    {
        return $this->servir('guias', $nombre);
    }

    public function taller(string $nombre): Response
    {
        return $this->servir('talleres', $nombre);
    }

    private function servir(string $tipo, string $nombre): Response
    {
        abort_unless(in_array($nombre, $this->archivosPermitidos[$tipo]), 404);

        $ruta = resource_path("{$tipo}/{$nombre}.html");
        abort_unless(file_exists($ruta), 404);

        $html = file_get_contents($ruta);
        $html = $this->inyectarNavbar($html);

        return response($html)->header('Content-Type', 'text/html; charset=utf-8');
    }

    private function inyectarNavbar(string $html): string
    {
        $usuario  = Auth::user()->name;
        $urlVolver = url('/modulos');
        $urlHome   = url('/');

        $navbar = <<<HTML
<div id="ec-nav" style="position:fixed;top:0;left:0;right:0;z-index:99999;background:#030712;border-bottom:1px solid rgba(255,255,255,0.08);height:50px;display:flex;align-items:center;padding:0 1.5rem;gap:1rem;font-family:'Sora',system-ui,sans-serif;box-shadow:0 2px 20px rgba(0,0,0,0.4);">
  <a href="{$urlVolver}" style="display:inline-flex;align-items:center;gap:0.4rem;text-decoration:none;color:#22d3ee;font-size:0.78rem;font-weight:500;padding:0.35rem 0.75rem;border:1px solid rgba(34,211,238,0.25);border-radius:10px;transition:background 0.2s;" onmouseover="this.style.background='rgba(34,211,238,0.08)'" onmouseout="this.style.background='transparent'">← Módulos</a>
  <div style="flex:1"></div>
  <span style="font-size:0.75rem;color:#6b7280;">👤 {$usuario}</span>
  <a href="{$urlHome}" style="display:inline-flex;align-items:center;gap:0.5rem;text-decoration:none;">
    <div style="width:26px;height:26px;border-radius:7px;background:linear-gradient(135deg,#22d3ee,#8b5cf6);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.72rem;color:white;flex-shrink:0;">E</div>
    <span style="font-weight:700;font-size:0.85rem;color:white;">EduCode</span>
  </a>
</div>
<style>body{padding-top:50px!important}#ec-nav *{box-sizing:border-box}</style>
HTML;

        return preg_replace('/<body([^>]*)>/', '<body$1>' . "\n" . $navbar, $html, 1);
    }
}
