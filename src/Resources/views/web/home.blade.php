<x-hub::layouts.web pageName="Home">
    <!-- Trending Category Section -->
    <section id="trending-category" class="trending-category section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="container" data-aos="fade-up">
          <div class="row g-5">
            <div class="col-lg-4">
              <div class="post-entry lg">
                <a href="blog-details.html"><img src="{{ url('/storage/app/public/' . $posts[0]->image) }}" alt="" class="img-fluid"></a>
                <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">•</span> <span>{{date('d M Y',strtotime($posts[0]->published_at))}}</span></div>
                <h2><a href="blog-details.html">{{$posts[0]->title}}</a></h2>
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
                  <div class="post-entry">
                    <a href="blog-details.html"><img src="{{ asset('hub/images/post-landscape-2.jpg') }}" alt="" class="img-fluid"></a>
                    <div class="post-meta"><span class="date">Sport</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                    <h2><a href="blog-details.html">Let’s Get Back to Work, New York</a></h2>
                  </div>
                  <div class="post-entry">
                    <a href="blog-details.html"><img src="{{ asset('hub/images/post-landscape-5.jpg') }}" alt="" class="img-fluid"></a>
                    <div class="post-meta"><span class="date">Food</span> <span class="mx-1">•</span> <span>Jul 17th '22</span></div>
                    <h2><a href="blog-details.html">How to Avoid Distraction and Stay Focused During Video Calls?</a></h2>
                  </div>
                  <div class="post-entry">
                    <a href="blog-details.html"><img src="{{ asset('hub/images/post-landscape-7.jpg') }}" alt="" class="img-fluid"></a>
                    <div class="post-meta"><span class="date">Design</span> <span class="mx-1">•</span> <span>Mar 15th '22</span></div>
                    <h2><a href="blog-details.html">Why Craigslist Tampa Is One of The Most Interesting Places On the Web?</a></h2>
                  </div>
                </div>
                <div class="col-lg-4 border-start custom-border">
                  <div class="post-entry">
                    <a href="blog-details.html"><img src="{{ asset('hub/images/post-landscape-3.jpg') }}" alt="" class="img-fluid"></a>
                    <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                    <h2><a href="blog-details.html">6 Easy Steps To Create Your Own Cute Merch For Instagram</a></h2>
                  </div>
                  <div class="post-entry">
                    <a href="blog-details.html"><img src="{{ asset('hub/images/post-landscape-6.jpg') }}" alt="" class="img-fluid"></a>
                    <div class="post-meta"><span class="date">Tech</span> <span class="mx-1">•</span> <span>Mar 1st '22</span></div>
                    <h2><a href="blog-details.html">10 Life-Changing Hacks Every Working Mom Should Know</a></h2>
                  </div>
                  <div class="post-entry">
                    <a href="blog-details.html"><img src="{{ asset('hub/images/post-landscape-8.jpg') }}" alt="" class="img-fluid"></a>
                    <div class="post-meta"><span class="date">Travel</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                    <h2><a href="blog-details.html">5 Great Startup Tips for Female Founders</a></h2>
                  </div>
                </div>
                <!-- Trending Section -->
                <div class="col-lg-4">
                  <div class="trending">
                    <h3>Trending</h3>
                    <ul class="trending-post">
                      <li>
                        <a href="blog-details.html">
                          <span class="number">1</span>
                          <h3>The Best Homemade Masks for Face (keep the Pimples Away)</h3>
                          <span class="author">Jane Cooper</span>
                        </a>
                      </li>
                      <li>
                        <a href="blog-details.html">
                          <span class="number">2</span>
                          <h3>17 Pictures of Medium Length Hair in Layers That Will Inspire Your New Haircut</h3>
                          <span class="author">Wade Warren</span>
                        </a>
                      </li>
                      <li>
                        <a href="blog-details.html">
                          <span class="number">3</span>
                          <h3>13 Amazing Poems from Shel Silverstein with Valuable Life Lessons</h3>
                          <span class="author">Esther Howard</span>
                        </a>
                      </li>
                      <li>
                        <a href="blog-details.html">
                          <span class="number">4</span>
                          <h3>9 Half-up/half-down Hairstyles for Long and Medium Hair</h3>
                          <span class="author">Cameron Williamson</span>
                        </a>
                      </li>
                      <li>
                        <a href="blog-details.html">
                          <span class="number">5</span>
                          <h3>Life Insurance And Pregnancy: A Working Mom’s Guide</h3>
                          <span class="author">Jenny Wilson</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div> <!-- End Trending Section -->
              </div>
            </div>
          </div> <!-- End .row -->
        </div>
      </div>
    </section><!-- /Trending Category Section -->   
</x-hub::layouts.web>