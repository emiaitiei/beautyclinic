<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class LanguageFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = \Config\Services::session();
        
        // Mengakses segmen pertama dari URI menggunakan $request->uri->getSegment()
        $lang = $request->getUri()->getSegment(1); // Menggunakan getUri() untuk mendapatkan objek URI
        
        // Cek apakah segmen pertama adalah bahasa yang valid
        if ($lang === 'en' || $lang === 'id') {
            // Jika segmen bahasa sudah ada, set bahasa di session
            if ($session->get('lang') !== $lang) {
                $session->set('lang', $lang);
                service('language')->setLocale($lang);
            }
        } else {
            // Jika tidak ada parameter bahasa, set default
            if (!$session->get('lang')) {
                $session->set('lang', 'id');
                service('language')->setLocale('id');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada tindakan setelah request diproses
    }
}
