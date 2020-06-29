@extends('templates/index')

@section('content')
    <div class="main">
      <div class="container">
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12">
            <h1>Search Results</h1>
            <div class="content-page">
              <form action="#" class="content-search-view2">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search..." id="_keyword" value="{{ $KEYWORD }}">
                  <span class="input-group-btn">
                    <button class="btn btn-primary" onclick="searching($('#_keyword').val());return false;" onsubmit="searching($('#_keyword').val());return false;">Search</button>
                  </span>
                </div>
              </form>

              @if(count($ARTICLE))
                @foreach($ARTICLE as $RESULT)
                <div class="search-result-item">
                  <h4><a href="javascript:;">{{ $RESULT->ARTICLE_TITLE }}</a></h4>
                  <p>{{ $RESULT->ARTICLE_PROLOG }}</p>
                  <!-- <a class="search-link" href="javascript:;">http://www.keenthemes.com</a> -->
                </div>
                @endforeach

                <div class="row">
                  {{ $ARTICLE->links() }}
                  <!-- <div class="col-md-4 col-sm-4 items-info">Items 1 to 9 of 10 total</div>
                  <div class="col-md-8 col-sm-8">
                    <ul class="pagination pull-right">
                      <li><a href="javascript:;">«</a></li>
                      <li><a href="javascript:;">1</a></li>
                      <li><span>2</span></li>
                      <li><a href="javascript:;">3</a></li>
                      <li><a href="javascript:;">4</a></li>
                      <li><a href="javascript:;">5</a></li>
                      <li><a href="javascript:;">»</a></li>
                    </ul>
                  </div> -->
                </div>

              @else
                <div class="search-result-item">
                  <h4>Data tidak ditemukan</h4>
                </div>
              @endif

            </div>
          </div>
          <!-- END CONTENT -->
        </div>
      </div>
    </div>
@endsection    