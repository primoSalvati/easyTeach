
<!-- achtung, questo era il calendar di coding with sara, o meglio era il suo inserimento nel framework, ma non lo uso -->
    <div class="container">
        <ul class="list-inline">
            <li class="list-inline-item"><a href="?ym={{ @prev }}" class="btn btn-link">&lt; prev</a></li>
            <li class="list-inline-item"><span class="title">"{{ @title }}"</span></li>
            <li class="list-inline-item"><a href="?ym={{ @next }}" class="btn btn-link">next &gt;</a></li>
        </ul>

        <!-- <pre>{{ var_dump(@weeks)}}</pre> -->
        <p class="text-right"><a href="/calendar">Today</a></p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>M</th>
                    <th>T</th>
                    <th>W</th>
                    <th>T</th>
                    <th>F</th>
                    <th>S</th>
                    <th>S</th>
                </tr>
            </thead>
            <tbody>


                <repeat group="{{ @weeks }}" value="{{ @calweek }}">
                    {{ @calweek | raw }}
                </repeat>
            </tbody>
        </table>
    </div>