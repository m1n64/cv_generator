@extends('layouts.app')

@section('content')
    <div class="columns">
        @include("layouts.grid")
        <div class="column is-10 main-column">
            <div class="card margin-top-15">
                <div class="content margin-left-20 margin-right-20 ">
                    <div class="columns">
                        <div class="column">
                            <h4>{{ __("Languages") }}</h4>
                            <div id="languagesList">

                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="columns">
                        <div class="column">
                            <div class="columns">
                                <div class="column">
                                    <select name="" id="languageId" class="js-choice">
                                        @foreach($languagesInfo['languages'] as $lang)
                                            <option value="{{ $lang->id }}">{{ $lang->name }} ({{ $lang->nativeName }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="column">
                                    <select name="" id="levelId" class="js-choice">
                                        @foreach($languagesInfo['levels'] as $lang)
                                            <option value="{{ $lang->id }}">{{ $lang->CEFR }} ({{ $lang->cambridge }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button class="button is-dark {{--js-modal-trigger--}}" data-target="modal-add-lang" id="addLanguage">{{ __("Add") }}</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="modal-add-lang" class="modal">
        <div class="modal-background"></div>

        <div class="modal-content">
            <div class="box">

            </div>
        </div>

        <button class="modal-close is-large" aria-label="close"></button>
    </div>

    {{-- ?????? ?????? ?????? ?? ???????????? ????????????????! --}}
    <template id="blockTemplate">
        <div class="" id="language-panel-">
            <hr>
            <div class="content">
                <strong class="lang_name" data-id=""></strong>
                <span class="lang_level" data-id=""></span>
                <span class="right">
                    {{--<button class="delete "></button>--}}
                    <button class="delete delete-lang" data-id=""></button>
                </span>
            </div>
        </div>
    </template>

    <script>
        window.langList = [
        @foreach($userLanguages as $userLanguage)
            {
                id: {{ $userLanguage->id }},
                langId: {{ $userLanguage->lang_id }},
                langName: "{{ $userLanguage->name }}",
                levelId: {{ $userLanguage->level_id }},
                CEFR: "{{ $userLanguage->CEFR }}",
                cambridge: "{{ $userLanguage->cambridge }}"
            },
        @endforeach
        ];
    </script>

@endsection
