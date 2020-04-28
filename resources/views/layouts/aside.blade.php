<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('home') }}" class="brand-link">
        <img src="{{ asset('images/bg-01.jpg')  }}" alt="UI_small2"
             class="brand-image img-circle" style="opacity: .8">
        <span class="brand-text font-weight-light"> {{ env('APP_NAME') }}</span>
        <span class="brand-text font-weight-light text-danger">  النقاط :  {{ $score }} </span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('myAnswers') }}" class="nav-link {{ activeClass2('myAnswers') }}">
                        <i class="nav-icon fas fa-circle"></i>
                        <p> اجاباتي</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('question.index')."?type=today" }}"
                       class="nav-link {{ activeClass2('type=today') }}">
                        <i class="nav-icon fas fa-question"></i>
                        <p>اسئلة اليوم الغير مجابة</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('question.index') }}" class="nav-link {{ activeClass2('question',true) }}">
                        <i class="nav-icon fas fa-question"></i>
                        <p>اسئلة الموسم</p>
                    </a>
                </li>

                @if(auth()->user()->isAdmin())
                    <li class="nav-item">
                        <a href="{{ route('question.create') }}" class="nav-link {{ activeClass2('question/create') }}">
                            <i class="nav-icon fas fa-plus"></i>
                            <p> اضافة سؤال جديد</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
