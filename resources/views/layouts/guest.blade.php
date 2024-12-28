@props(['title' => '', 'bodyClass' => '', 'pageLink' => '', 'buttonText' => ''])
<x-base-layout :$title :$bodyClass>
    <main>
      <div class="container-small page-login">
          <div class="flex" style="gap: 5rem">
              <div class="auth-page-form">
                  <div class="text-center">
                      <a href="/">
                          <img src="/img/logoipsum-265.svg" alt="" />
                      </a>
                  </div>
                  <h1 class="auth-page-title">{{$title}}</h1>
  
                  <form action="" method="post">
                      
                        {{ $slot}}
  
                      <button class="btn btn-primary btn-login w-full">{{ $buttonText }}</button>
  
                      <div class="grid grid-cols-2 gap-1 social-auth-buttons">
                        <x-gg-button />
                        <x-fb-button />
                      </div>
                     
                      {{ $pageLink }}
                  </form>
              </div>
              <div class="auth-page-image">
                  <img src="/img/car-png-39071.png" alt="" class="img-responsive" />
              </div>
          </div>
      </div>
  </main>
  </x-base-layout>