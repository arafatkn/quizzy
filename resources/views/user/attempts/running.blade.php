@extends('user.layouts.master')

@section('title', "Running Quiz : {$quiz->name}")

@section('content')

    <div class="row justify-content-center">
        <div class="col-auto mb-2">
            <div class="d-grid">
                <button class="btn btn-danger btn-lg">Time Remaining: <span id="time_countdown">{{ $quiz->time_limit_as_text }}</span></button>
            </div>
        </div>
        <div class="col-auto mb-2">
            <button class="btn btn-lg btn-primary" id="finishBtn">Finish Quiz</button>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <h3 class="text-center">{{ $quiz->name }}</h3>
        </div>
        <div class="card-body">

            <div class="card">
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
                <button @click="goNextQuestion" class="btn btn-success btn-lg px-5 mb-3">Next Question &rarr;</button>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>

    <script>
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
            },

            methods: {
                goNextQuestion() {
                    this.current_index ++;
                },

                goPreviousQuestion() {
                    this.current_index --;
                },

                updateAnswer(qid, ans) {
                    this.answers[qid] = ans;
                }
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
