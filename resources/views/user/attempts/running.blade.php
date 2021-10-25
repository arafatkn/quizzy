@extends('user.layouts.master')

@section('title', "Running Quiz : {$quiz->name}")

@section('content')

    <div v-if="message" class="alert alert-dismissible position-fixed fade show top-0 end-0" :class="alert_type" role="alert">
        @{{ message }}
        <button type="button" class="btn-close" @click="message=null" aria-label="Close"></button>
    </div>

    <div class="row justify-content-center">
        <div class="col-auto mb-2">
            <div class="d-grid">
                <button class="btn btn-danger btn-lg">Time Remaining: <span id="time_countdown">{{ $quiz->time_limit_as_text }}</span></button>
            </div>
        </div>
        <div class="col-auto mb-2">
            <button class="btn btn-lg btn-primary" id="finishBtn" @click="finishNow()" :disabled="loading">
                <span v-if="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Finish Quiz
            </button>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header d-flex justify-content-between">
            <span class="h3">{{ $quiz->name }}</span>
            <button class="btn btn-primary" @click="saveProgress">
                <i class="bi bi-save-fill"></i>
                <span class="d-none d-sm-inline-block">Save Progress</span>
            </button>
        </div>
        <div class="card-body">

            <nav v-if="questions.length > 0" aria-label="Questions Navigation">
                <ul class="pagination" style="overflow-x: scroll;" id="qNav">
                    <li class="page-item" v-for="i in questions.length" :class="(current_index === i-1? 'active' : '')">
                        <a
                            :class="(answers[questions[i-1].id] && current_index !== i-1) ? 'bg-success text-white' : ''"
                            @click="goToQuestion(i-1)"
                            class="page-link"
                            href="javascript:void(0)"
                        >
                            @{{ i }}
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="card" id="qCard">
                <div class="card-header">
                    @{{ question.question }}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6 d-grid gap-2" v-for="(option, key) in question.options">
                            <button
                                @click="updateAnswer(question.id, key)"
                                :class="'btn btn'+(answers[question.id] == key ? '' : '-outline')+'-primary mb-2'"
                            >
                                @{{  option }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            {{--id="ansBtn_{{ $quiz->questions[0]->id }}_{{ $key }}"--}}

            <div class="text-center mt-3">
                <button @click="goPreviousQuestion" class="btn btn-secondary btn-lg px-5 mb-3" :disabled="current_index <= 0">&larr; Previous</button>
                <button @click="goNextQuestion" class="btn btn-success btn-lg px-5 mb-3" :disabled="current_index+1 >= questions.length">Next Question &rarr;</button>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('/js/vue@2.6.14.min.js') }}"></script>
{{--    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>--}}

    <script>

        window.onresize = setQuestionNavigationWidth;

        function setQuestionNavigationWidth() {
            document.getElementById("qNav").style.width = document.getElementById("qCard").clientWidth + "px";
        }

        setQuestionNavigationWidth();

        let answers = @json($attempt->answers);
        let questions = @json($questions);

        var vapp = new Vue({
            el: '#vapp',

            data: {
                answers: answers,
                questions: questions,
                question: {},
                answer: null,
                current_index: 0,
                loading: false,
                message: '',
                alert_type: 'alert-info',
            },

            methods: {
                goNextQuestion() {
                    this.current_index ++;
                },

                goPreviousQuestion() {
                    this.current_index --;
                },

                goToQuestion(i) {
                    this.current_index = i;
                },

                updateAnswer(qid, ans) {
                    this.answers[qid] = ans;
                },

                saveProgress() {
                    this.submitAnswers(false);
                },

                finishNow() {
                    this.submitAnswers(true);
                },

                submitAnswers(finish) {
                    this.loading = true;
                    let url = "{{ route('user.attempts.update', $attempt->id) }}";
                    axios.put(url, {
                            _method: 'PUT',
                            answers: this.answers,
                            submit: finish,
                        })
                        .then(function (response) {
                            if ( response.data.redirect ) {
                                alert(response.data.message);
                                window.location.href = response.data.redirect;
                            } else {
                                vapp.alert_type = (response.status === 202) ? 'alert-success' : 'alert-danger';
                                vapp.message = response.data.message;
                                setTimeout(() => vapp.message = null, 3000);
                            }
                        })
                        .catch(function (error) {
                            if (error.response && error.response.data && error.response.data.message) {
                                alert(error.response.data.message);
                            } else {
                                console.log(error);
                            }
                        })
                        .finally(() => this.loading = false);
                },
            },

            watch: {
                current_index() {
                    this.question = this.questions[this.current_index];
                }
            },

            created() {
                if (this.questions.length)
                    this.question = this.questions[0];
            }
        });

        var countDownDate = (new Date().getTime()) + {{ $attempt->time_remaining }} * 1000;

        // Update the count down every 1 second
        var x = setInterval(function() {

            let distance = countDownDate - new Date().getTime();

            if (distance < 0) {
                clearInterval(x);
                document.getElementById("time_countdown").innerText = "EXPIRED";
                document.getElementById("finishBtn").click();
            }

            let hours = Math.floor(distance / (1000 * 60 * 60));
            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("time_countdown").innerText = `${hours} Hr ${minutes} Min ${seconds} Sec`;

        }, 1000);
    </script>
@endsection
