@if ($paginator->hasPages())

    @php
        //    dd($paginator->count());// მიიღეთ ელემენტების რაოდენობა მიმდინარე გვერდისთვის.
        //    dd($paginator->currentPage()); // მიიღეთ მიმდინარე გვერდის ნომერი.
        //    dd($paginator->firstItem());// მიიღეთ შედეგების პირველი ელემენტის შედეგის ნომერი.
        //    dd($paginator->lastItem());// მიიღეთ შედეგების ბოლო ელემენტის შედეგის ნომერი.
        //    dd($paginator->getOptions());// მიიღეთ paginator პარამეტრები.
        //    dd($paginator->hasPages());// დაადგინეთ არის თუ არა საკმარისი ელემენტი რამდენიმე გვერდად გასაყოფად.
        //    dd($paginator->hasMorePages()); // აქვს თუ არ ამიმდინარე გვერდის შემდეგ კიდევ გვერდი
        //    dd($paginator->items()); // მიიღეთ ელემენტები მიმდინარე გვერდისთვის.
        //    dd($paginator->lastPage()); // მიიღეთ ბოლო ხელმისაწვდომი გვერდის გვერდის ნომერი.
        //    dd($paginator->nextPageUrl()); //მიიღეთ URL შემდეგი გვერდისთვის
        //    dd($paginator->onFirstPage()); //დაადგინეთ არის თუ არა პაგინატორი პირველ გვერდზე.
        //    dd($paginator->perPage()); //ერთეულების რაოდენობა გვერდზე
        //    dd($paginator->previousPageUrl()); // მიიღეთ URL წინა გვერდისთვის.
        //    dd($paginator->total()); //დაადგინეთ შესატყვისი ელემენტების საერთო რაოდენობა მონაცემთა მაღაზიაში.
        //    dd($paginator->getPageName()); // მიიღეთ შეკითხვის სტრიქონის ცვლადი, რომელიც გამოიყენება გვერდის შესანახად
        //    dd($paginator->url(2)); // მიიღეთ URL მოცემული გვერდის ნომრისთვის.
        //    dd($paginator->setPageName('ტესტ')) // დააყენეთ შეკითხვის სტრიქონის ცვლადი, რომელიც გამოიყენება გვერდის შესანახად
        //    dd($paginator->getUrlRange(2, 4)); // შექმენით პაგინაციის URL-ების დიაპაზონი.
    @endphp


    <style>
        .pagination__container {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }

        .pagination li {
            margin: 10px;
            background: var(--todua-blue-dark);
            color: white;
        }

        .page{
            display: flex;
            justify-content: center;
            align-items: center;
            width: 35px;
            height: 40px;
            color: var(--todua-blue-dark);
            background-color: white;
            border: 1px solid var(--todua-blue-dark);
        }

        .page{
            display: flex;
            justify-content: center;
            align-items: center;
            width: 35px;
            height: 40px;
            color: var(--todua-blue-dark);
            background-color: white;
            border: 1px solid var(--todua-blue-dark);
        }

        .page:hover{
            color: white !important;
            background-color: var(--todua-blue-dark);
            border: 1px solid var(--todua-blue-dark);
        }

        .active .page{
            color: white !important;
            background-color: var(--todua-blue-dark);
            border: 1px solid var(--todua-blue-dark);
            cursor: pointer;
        }

        .pagination__info{
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        .from__pagination{
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            margin:10px;
        }
        .till__pagination{
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            margin:10px;
        }

    </style>

    <div class="pagination__container">

        <div class="pagination__info">

            <p class="from__pagination">
                {{$paginator->firstItem()}}
            </p>
            <span> - </span>
            <p class="till__pagination">
                {{$paginator->lastItem()}}
            </p>
            <p class="all__pagination">
                <span>{{ __('admin.all') }}</span>
                {{$paginator->total()}}
            </p>

        </div>

        <ul class="pagination">

            @if (!$paginator->onFirstPage())

{{--                <li class="">--}}
{{--                    <a class="page" href="{{ $paginator->url(1) }}">--}}
{{--                        <i class="fa-solid fa-circle-chevron-left"></i>--}}
{{--                    </a>--}}
{{--                </li>--}}

                <li class="">
                    <a class="page" href="{{ $paginator->previousPageUrl() }}">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                </li>

            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page disabled">{{ $element }}</li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <a class="page">{{ $page }}</a>
                            </li>
                        @else
                            <li class="">
                                <a class="page" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())

                <li>
                    <a class="page" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                </li>

{{--                <li class="">--}}
{{--                    <a class="page" href="{{ $paginator->url($paginator->lastPage()) }}">--}}
{{--                        <i class="fa-solid fa-circle-chevron-right"></i>--}}
{{--                    </a>--}}
{{--                </li>--}}

            @endif


        </ul>

    </div>

@endif