<?php

namespace App\Support;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

/**
 * Menu aplikasi (config/bios_menu.php) untuk sidebar, breadcrumb, dan judul.
 */
class BiosMenu
{
    /** Grup menu yang boleh dilihat pengguna saat ini. */
    public static function groups(): array
    {
        $groups = [];
        foreach (config('bios_menu', []) as $key => $group) {
            $allowed = false;
            foreach ($group['roles'] ?? [] as $role) {
                if (Gate::allows($role)) {
                    $allowed = true;
                    break;
                }
            }
            if (! $allowed) {
                continue;
            }
            $items = [];
            foreach ($group['items'] as $route => $label) {
                if (Route::has($route)) {
                    $items[$route] = $label;
                }
            }
            $groups[$key] = ['items' => $items] + $group;
        }

        return $groups;
    }

    /** Grup dan judul halaman yang sedang dibuka. */
    public static function current(): array
    {
        $name = Route::currentRouteName();
        foreach (config('bios_menu', []) as $key => $group) {
            if (isset($group['items'][$name])) {
                return ['group' => $key, 'group_label' => $group['label'], 'group_short' => $group['short'], 'label' => $group['items'][$name], 'route' => $name];
            }
        }

        return ['group' => null, 'group_label' => null, 'group_short' => null, 'label' => null, 'route' => $name];
    }

    /** Jumlah formulir pengiriman per grup (untuk halaman beranda). */
    public static function count(string $group): int
    {
        return count(config("bios_menu.$group.items", []));
    }
}
