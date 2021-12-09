@extends('layouts.main')

@section('content')
    <main class="blog">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <section>
                        <div class="">
                            <div class="card__list">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Id Prod</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Price</th>
{{--                                        <th scope="col">Удалить</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody class="table__tbody">
                                    @php
                                        $itogo=0;
                                    @endphp
                                    @foreach($cart as $elem)
                                        @php
                                            $itogo+=$elem['products']->price;
                                        @endphp
                                        <tr>
                                            <th scope="row">{{ $elem['products']->id }}</th>
                                            <th scope="row">{{ $elem['products']->title }}</th>
                                            <th scope="row"><img src="{{ 'storage/'. $elem['products']->preview_image }}"
                                                                           class="img-carts"></th>
                                            <th scope="row">{{ $elem['products']->price }}</th>
{{--                                            <th class="d-flex">--}}
{{--                                                <form class="button__del">--}}
{{--                                                    <input name="id" type="hidden" value="{{ $elem['products']->id }}">--}}
{{--                                                    @csrf--}}
{{--                                                    @method('DELETE')--}}
{{--                                                    <button type="submit" class="widget-title del">-</button>--}}
{{--                                                </form>--}}
{{--                                            </th>--}}
                                        </tr>
                                    @endforeach()
                                    <tr>
                                        <th colspan="3"><strong>Итого:</strong></th>
                                        <th><strong>{{ $itogo }}</strong></th>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div>
                            <form class="button__clear">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="widget-title clear">Очистить корзину</button>
                            </form>
                        </div>
                    </section>
                    <script>
                        let list = document.querySelector('.table__tbody');

                        makeCartClear = async (e) => {
                            e.preventDefault();
                            let response = await fetch('/list', {
                                method: 'POST',
                                body: new FormData(e.target.parentElement),
                            });
                            showTotalCart();
                            let result = await response.json();
                            if(result.success) {
                                list.innerHTML = ''
                            }
                            else {
                                console.log('Error');
                            }
                        };
                        document.querySelector(".widget-title.clear").addEventListener('click', window.makeCartClear, false);
                    </script>
                </div>
                @component('components.total', ['total' => $total])
                @endcomponent
            </div>
        </div>

    </main>
@endsection()
