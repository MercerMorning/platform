@extends('platform::layouts.dashboard')

@section('title',$name)
@section('description',$description)

@section('navbar')

    <ul class="nav justify-content-end  v-center">
        <li class="nav-item">
            <button type="button" class="btn btn-link dz-clickable" id="upload"><i class="icon-cloud-upload"></i>
                Загрузка
            </button>
        </li>
        <li class="nav-item">
            <button type="button" class="btn btn-link" id="new_folder"
                    onclick="jQuery('#new_folder_modal').modal('show');"><i class="icon-folder-alt"></i>
                Создать новую папку
            </button>
        </li>
        <li class="nav-item">
            <button type="button" class="btn btn-link" id="refresh"><i class="icon-refresh"></i>
                Обновить
            </button>
        </li>
        <li class="nav-item">
            <button type="button" class="btn btn-link" id="move"><i class="icon-cursor-move"></i>
                Переместить
            </button>
        </li>
        <li class="nav-item">
            <button type="button" class="btn btn-link" id="rename"><i class="icon-font"></i>
                Переименовать
            </button>
        </li>
        <li class="nav-item">
            <button type="button" class="btn btn-link" id="delete"><i class="icon-trash"></i>
                Удалить
            </button>
        </li>
    </ul>


@endsection

@section('aside')

    <div id="aside-filemanager" class="col wi-col no-padder">
        <div class="right_none_selected" style="display: none;"><i class="icon-cursor"></i>
            <p> Ничего не выбрано</p></div>

        <div class="wrapper detail v-center text-center">
            <a href="#">
                <img src="https://sun1-1.userapi.com/c830400/v830400092/caa37/Oavd1uZzq4Q.jpg" class="img-responsive b">
            </a>

            <!-- <i class="icon-folder-alt"></i>-->
        </div>

        <div class="divider b-t m-t-sm b-dark"></div>


        <div class="wrapper">
            <div class="row">
                <div class="col-md-6">
                    Название :
                </div>

                <div class="col-md-6">
                    01
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    Тип файла:
                </div>

                <div class="col-md-6">
                    folder
                </div>
            </div>
        </div>

    </div>

@endsection




@section('content')

    <style>

        #filemanager table img {
            width:      40px;
            height:     40px;
            object-fit: cover;
        }

        #filemanager table .main-icon {
            font-size: 30px;
        }

        #aside-filemanager .detail {
            width:      100%;
            min-height: 200px;
            font-size:  80px;
        }

        #aside-filemanager .detail * {
            margin:     0 auto;
            object-fit: cover;
            width:      100%;
            height:     auto;
        }

    </style>



    <div id="filemanager">
        <div id="content">
            <div class="breadcrumb-container">
                <ol class="breadcrumb filemanager b-t small">
                    <li data-folder="/" data-index="0" class="selected"><span class="arrow"></span>
                        <span> Медиа библиотека</span></li>
                    <li data-folder="2018" data-index="1"><span class="arrow"></span>2018</li>
                    <li>
                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            <span class="icon-plus-alt wrapper-xs b"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#"><i class="icon-cloud-upload"></i> Загрузить</a>
                            <a class="dropdown-item" href="#"><i class="icon icon-folder-alt"></i> Каталог</a>
                            <a class="dropdown-item" href="#"><i class="icon-doc"></i> Текстовый файл</a>
                        </div>
                    </li>
                </ol>
            </div>


            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th width="80px" class="text-center"></th>
                        <th width="70%" class="text-left">
                            <a href="?sort=content.ru.name" class=" text-muted ">
                                Name
                            </a>
                        </th>
                        <th class="text-left">

                        </th>
                        <th width="" class="text-left">
                            <a href="?sort=publish_at" class=" text-muted ">
                                Size
                            </a>
                        </th>
                        <th width="" class="text-left">
                            <a href="?sort=created_at" class=" text-muted ">
                                Modified
                            </a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    {{-- Directories--}}
                    @foreach($directories as $directory)
                        <tr>
                            <td class="text-center">

                                <a href="http://localhost:8000/dashboard/press/posts/demo/wefewfwe/edit">
                                    <i class="icon icon-folder-alt main-icon"></i> </a>

                            </td>
                            <td class="text-left">
                                <a href="http://localhost:8000/dashboard/press/posts/demo/wefewfwe/edit">
                                    {{$directory['name']}}
                                </a>
                            </td>
                            <td class="text-left">
                                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-options"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#"><i class="icon-cloud-upload"></i> Загрузить</a>
                                    <a class="dropdown-item" href="#"><i class="icon icon-folder-alt"></i> Каталог</a>
                                    <a class="dropdown-item" href="#"><i class="icon-doc"></i> Текстовый файл</a>
                                </div>
                            </td>
                            <td class="text-left">
                                - KB
                            </td>
                            <td class="text-left">
                                {{$directory['humanLastModified']}}
                            </td>
                        </tr>
                    @endforeach
                    {{-- Directories--}}
                    {{-- Files--}}
                    @foreach($files as $file)
                        <tr>
                            <td class="text-center">
                                <a href="http://localhost:8000/dashboard/press/posts/demo/wefewfwe/edit">
                                    @if (str_is('image*',$file['type']))
                                        <img src="{{$file['path']}}" class="img-responsive">
                                    @elseif(str_is('video*',$file['type']))
                                            <i class="main-icon icon icon-camrecorder"></i>
                                    @elseif (str_is('audio*',$file['type']))
                                        <i class="main-icon icon icon-music-tone"></i>
                                    @else
                                        <i class="main-icon icon icon-doc"></i>
                                    @endif
                                </a>

                            </td>
                            <td class="text-left">
                                <a href="http://localhost:8000/dashboard/press/posts/demo/wefewfwe/edit">
                                    {{$file['name']}}
                                </a>
                            </td>
                            <td class="text-left">
                                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-options"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#"><i class="icon-cloud-upload"></i> Загрузить</a>
                                    <a class="dropdown-item" href="#"><i class="icon icon-folder-alt"></i> Каталог</a>
                                    <a class="dropdown-item" href="#"><i class="icon-doc"></i> Текстовый файл</a>
                                </div>
                            </td>
                            <td class="text-left">
                                {{$file['size']}} KB
                            </td>
                            <td class="text-left">
                                {{$file['humanLastModified']}}
                            </td>
                        </tr>
                    @endforeach
                    {{-- Files--}}
                    </tbody>
                </table>
            </div>

            <footer class="card-footer col">
                <div class="row">
                    <div class="col-sm-5">
                        <small class="text-muted inline m-t-sm m-b-sm">{{$directories->count()}} folders
                                                                                                 and {{$files->count()}}
                                                                                                 files
                        </small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">

                    </div>
                </div>
            </footer>


        </div>

    </div>
@stop