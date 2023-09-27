@if (session('message'))
           @php
            $message = session('message');
            @endphp
            <div class="alert alert-{{ $message['type'] }}">
              {{ $message['mgs'] }}
            </div>
          @endif  