<div>
    <div class="page-title">
        <div class="row">
            <div class="col-12 order-md-1 order-last">
                @if(@$pageTitle)
                    {!! @$pageTitle !!}
                @else
                    <h3>{{ @$title }}</h3>
                @endif

                @if(@$subtitle)
                    <p class="text-subtitle text-muted">{{ @$subtitle }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
