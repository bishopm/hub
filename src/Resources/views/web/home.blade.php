<x-hub::layouts.web pageName="Home">
    <!-- Trending Category Section -->
    <section id="trending-category" class="trending-category section">
      <div class="row g-5">
        <div class="col-lg-4">
          <div class="post-entry lg">
            <a href="blog-details.html"><img src="{{ asset('storage/public/' . $posts[0]->image) }}" alt="" class="img-fluid"></a>
            <div class="post-meta"><span class="date">
              @foreach ($posts[0]->tags as $tag)
                {{$tag->name}} <span class="mx-1">•</span>
              @endforeach
              </span> <span>{{date('d M Y',strtotime($posts[0]->published_at))}}</span>
            </div>
            <h2><a href="{{url('/blog') . '/' . date('Y',strtotime($posts[0]->published_at)) . '/' . date('m',strtotime($posts[0]->published_at)) . '/' . $posts[0]->slug}}">{{$posts[0]->title}}</a></h2>
            {!!$posts[0]->excerpt!!}
            <div class="d-flex align-items-center author">
              <div class="name">
                <h3 class="m-0 p-0">{{$posts[0]->person->firstname}} {{$posts[0]->person->surname}}</h3>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="row g-5">
            <div class="col-lg-4 border-start custom-border">
              @if (isset($posts[1]))
                <div class="post-entry">
                  <a href="{{url('/blog') . '/' . date('Y',strtotime($posts[1]->published_at)) . '/' . date('m',strtotime($posts[1]->published_at)) . '/' . $posts[1]->slug}}"><img src="{{ asset('storage/public/' . $posts[1]->image) }}" alt="" class="img-fluid"></a>
                  <div class="post-meta"><span class="date">
                    @foreach ($posts[1]->tags as $tag)
                      {{$tag->name}} <span class="mx-1">•</span>
                    @endforeach
                  </span> <span>{{date('d M Y',strtotime($posts[1]->published_at))}}</span></div>
                  <h2><a href="{{url('/blog') . '/' . date('Y',strtotime($posts[1]->published_at)) . '/' . date('m',strtotime($posts[1]->published_at)) . '/' . $posts[1]->slug}}">{{$posts[1]->title}}</a></h2>
                </div>
              @endif
              @if (isset($posts[2]))
                <div class="post-entry">
                  <a href="{{url('/blog') . '/' . date('Y',strtotime($posts[2]->published_at)) . '/' . date('m',strtotime($posts[2]->published_at)) . '/' . $posts[2]->slug}}"><img src="{{ asset('storage/public/' . $posts[2]->image) }}" alt="" class="img-fluid"></a>
                  <div class="post-meta"><span class="date"> 
                    @foreach ($posts[2]->tags as $tag)
                      {{$tag->name}} <span class="mx-1">•</span>
                    @endforeach
                    </span> <span>{{date('d M Y',strtotime($posts[2]->published_at))}}</span>
                  </div>
                  <h2><a href="{{url('/blog') . '/' . date('Y',strtotime($posts[2]->published_at)) . '/' . date('m',strtotime($posts[2]->published_at)) . '/' . $posts[2]->slug}}">{{$posts[2]->title}}</a></h2>
                </div>
              @endif
            </div>
            <div class="col-lg-4 border-start custom-border">
              @if (isset($posts[3]))
              <div class="post-entry">
                <a href="{{url('/blog') . '/' . date('Y',strtotime($posts[3]->published_at)) . '/' . date('m',strtotime($posts[3]->published_at)) . '/' . $posts[3]->slug}}"><img src="{{ asset('storage/public/' . $posts[3]->image) }}" alt="" class="img-fluid"></a>
                <div class="post-meta"><span class="date">
                  @foreach ($posts[3]->tags as $tag)
                    {{$tag->name}} <span class="mx-1">•</span>
                  @endforeach
                  </span> <span>{{date('d M Y',strtotime($posts[3]->published_at))}}</span>
                </div>
                <h2><a href="{{url('/blog') . '/' . date('Y',strtotime($posts[3]->published_at)) . '/' . date('m',strtotime($posts[3]->published_at)) . '/' . $posts[3]->slug}}">{{$posts[3]->title}}</a></h2>
              </div>
              @endif
              @if (isset($posts[4]))
              <div class="post-entry">
                <a href="{{url('/blog') . '/' . date('Y',strtotime($posts[4]->published_at)) . '/' . date('m',strtotime($posts[4]->published_at)) . '/' . $posts[4]->slug}}"><img src="{{ asset('storage/public/' . $posts[4]->image) }}" alt="" class="img-fluid"></a>
                <div class="post-meta"><span class="date">
                  @foreach ($posts[4]->tags as $tag)
                    {{$tag->name}} <span class="mx-1">•</span>
                  @endforeach
                  </span> <span>{{date('d M Y',strtotime($posts[4]->published_at))}}</span>
                </div>
                <h2><a href="{{url('/blog') . '/' . date('Y',strtotime($posts[4]->published_at)) . '/' . date('m',strtotime($posts[4]->published_at)) . '/' . $posts[4]->slug}}">{{$posts[4]->title}}</a></h2>
              </div>
              @endif
            </div>
            <!-- Trending Section -->
            <div class="col-lg-4">
              <div class="trending">
                <h3>Today@theHub</h3>
              </div>
            </div> <!-- End Trending Section -->
          </div>
        </div>
      </div> <!-- End .row -->
    </section><!-- /Trending Category Section -->   
</x-hub::layouts.web>