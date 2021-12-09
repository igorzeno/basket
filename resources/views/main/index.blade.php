@extends('layouts.main')

@section('content')
    <main class="blog">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <section>
                        <div class="row blog-post-row">
                            @foreach($products as $product)
                                <div class="col-md-6 blog-post">
                                    <div class="blog-post-thumbnail-wrapper">
                                        <img src="{{ 'storage/'. $product->preview_image }}" alt="blog post">
                                    </div>
                                    <p class="blog-post-category">{{ ucfirst(trans($product->title)) }}</p>
                                    <div class="add__line">
                                        <a href="#" class="blog-post-permalink">
                                            <h6 class="blog-post-title">{{ $product->price }}</h6>
                                        </a>
                                        @auth

                                            <form class="button__add">
                                                <input name="id" type="hidden" value="{{ $product->id }}">
                                                @csrf
                                                <button type="submit" class="widget-title add"
                                                    @if ($product->cartBy(auth()->user()))
                                                    disabled
                                                    @endif
                                                >Add +
                                                </button>
                                            </form>

                                            <form class="button__del">
                                                <input name="id" type="hidden" value="{{ $product->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="widget-title del"
                                                    @if (!$product->cartBy(auth()->user()))
                                                        disabled
                                                    @endif
                                                >Del -</button>
                                            </form>

                                        @endauth
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row paginate">
                            <div class="mx-auto" style="">
                                {{ $products->links() }}
                            </div>
                        </div>
                    </section>
                </div>
                @component('components.total', ['total' => $total])
                @endcomponent
            </div>
        </div>

    </main>
@endsection()
