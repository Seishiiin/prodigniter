<?php

    namespace App\Filters;

    use CodeIgniter\Filters\FilterInterface;
    use CodeIgniter\HTTP\RequestInterface;
    use CodeIgniter\HTTP\ResponseInterface;

    class AuthProtect implements FilterInterface {

        public function before(RequestInterface $request, $arguments = null) {
            $session = session();

            if ($session -> has('admin')) {
                if (!$session -> get('admin')) {
                    return redirect() -> to('/');
                }
            } else {
                return redirect() -> to('/');
            }
        }

        public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
    }