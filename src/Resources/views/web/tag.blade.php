<x-hub::layouts.web pageName="Subject">
    <section class="single-post-content">
        <div class="container">
            <div class="row">
                <div class="col-md-9 post-content" data-aos="fade-up">
                    <div class="single-post">
                        <h1 class="text-uppercase">{{$tag->name}}</h1>
                        @if (count($posts))
                            <h4>Blog posts</h4>
                            @foreach ($posts as $post)
                                <a href="{{url('/blog') . '/' . date('Y',strtotime($post['published_at'])) . '/' . date('m',strtotime($post['published_at'])) . '/' . $post['slug']}}">{{$post['title']}}</a><br>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-hub::layout>                
