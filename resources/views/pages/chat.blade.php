@extends('layouts.index')
@section('content')

     <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">
                    作者
                    <span class="badge badge-primary badge-pill">2</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action">前端工程师</a>
                <a href="#" class="list-group-item list-group-item-action">后端工程师</a>
                <a href="#" class="list-group-item list-group-item-action">产品经理</a>
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <ul class="list-unstyled">
                    <li class="media">
                        <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1577944718482&di=e037adfbbf38f808b4784db8f539a44e&imgtype=jpg&src=http%3A%2F%2F5b0988e595225.cdn.sohucs.com%2Fimages%2F20190524%2F625e7a778d8041df82629db1c630c9e2.jpeg" width="50" height="50" class="align-self-start mr-3" alt="...">
                        <div class="media-body">
                            <h6 class="mt-0 mb-1">Web-Chat 作者</h6>
                            <p>test</p>
                        </div>
                    </li>
                    <li class="media my-4">
                        <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1577944718482&di=e037adfbbf38f808b4784db8f539a44e&imgtype=jpg&src=http%3A%2F%2F5b0988e595225.cdn.sohucs.com%2Fimages%2F20190524%2F625e7a778d8041df82629db1c630c9e2.jpeg" width="50" height="50" class="align-self-start mr-3" alt="...">
                        <div class="media-body">
                            <h6 class="mt-0 mb-1">Web-Chat 作者</h6>
                            <p>菜鸡</p>
                        </div>
                    </li>
                    <li class="media my-4 text-right">
                        <div class="media-body">
                            <h6 class="mt-0 mb-1">产品经理</h6>
                            <p>你好我好才是真的好</p>
                        </div>
                        <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1577944718482&di=e037adfbbf38f808b4784db8f539a44e&imgtype=jpg&src=http%3A%2F%2F5b0988e595225.cdn.sohucs.com%2Fimages%2F20190524%2F625e7a778d8041df82629db1c630c9e2.jpeg" width="50" height="50" class="align-self-start ml-3" alt="...">
                    </li>
                </ul>


                <form action="">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1"><small>发送你要说的话</small></label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">发送
                    </button>
                </form>
            </div>
        </div>
     </div>


@endsection