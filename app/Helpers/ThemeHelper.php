<?php

//if(!function_exists('getCurrentTheme')) {
//    function getCurrentTheme(): string
//    {
//
//       if(session()->has('theme')) {
//
//           return session('theme');
//
//       }
//
//        session()->put('theme', 'light');
//
//        return 'light';
//    }
//}
//
//if(!function_exists('toggleTheme')) {
//    function toggleTheme(): void
//    {
//
//        if (session()->has('theme')) {
//
//            $theme = session('theme');
//
//            session()->put('theme', ($theme == 'light') ? 'dark' : 'light');
//        }
//    }
//}
