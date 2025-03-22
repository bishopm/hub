<x-hub::layouts.web pageName="Subject">
    <section class="single-post-content">
        <div class="container">
            <div class="row">
                <h1 class="text-uppercase">{{ucwords(str_replace('-', ' ', $slug))}}</h1>
                <div class="col-md-4 post-content" data-aos="fade-up">
                    @if (count($groups))
                        <h4>Groups</h4>
                        @foreach ($groups as $group)
                            <a href="{{url('/groups') . '/' .  $group['slug']}}">{{$group['tenant']}}</a><br>
                        @endforeach
                    @endif
                </div>
                <div class="col-md-4 post-content" data-aos="fade-up">
                    @if (count($projects))
                        <h4>Projects</h4>
                        @foreach ($projects as $project)
                            <a href="{{url('/projects') . '/' . $project['slug']}}">{{$project['project']}}</a><br>
                        @endforeach
                    @endif
                </div>
                <div class="col-md-4 post-content" data-aos="fade-up">
                    @if (count($posts))
                        <h4>Blog posts</h4>
                        @foreach ($posts as $post)
                            <a href="{{url('/blog') . '/' . date('Y',strtotime($post['published_at'])) . '/' . date('m',strtotime($post['published_at'])) . '/' . $post['slug']}}">{{$post['title']}}</a><br>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-hub::layout>                
