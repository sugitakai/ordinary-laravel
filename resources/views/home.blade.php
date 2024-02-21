@extends('layouts.app')
@section('content')
@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="/css/official_home.css">
<link rel="stylesheet" href="/css/margin.css">
<link rel="stylesheet" href="/css/massage2.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
@stop
@section('js')
<script src=""></script>
@stop

<div id="app">
    <div class="container">
        <div class="row">
            @if (session()->has('success'))
            <div class="alert alert-success font-bold" role="alert">
                {{ session('success') }}
            </div>
            @endif
            <section class=" py-5 bg-white rounded mx-auto shadow col-md-6">
                <div class="index_news cb_contents num3">
                    <h3 class="headline rich_font">NEWS</h3>
                    <div class="news_list clearfix">
                        <article class="item">
                            <a class="link clearfix gothic_font" href="#">
                                <p class="date" style="color:593306;"><time class="entry-date updated" datetime="2024-01-31T19:02:12+09:00">2024.01.31</time></p>
                                <h3 class="title"><span>冬のアロマフェア♪</span></h3>
                            </a>
                        </article>
                        <article class="item">
                            <a class="link clearfix gothic_font" href="#">
                                <p class="date" style="color:593306;"><time class="entry-date updated" datetime="2023-11-30T17:21:50+09:00">2023.11.30</time></p>
                                <h3 class="title"><span>年末年始の営業のお知らせ</span></h3>
                            </a>
                        </article>
                        <article class="item">
                            <a class="link clearfix gothic_font" href="#">
                                <p class="date" style="color:593306;"><time class="entry-date updated" datetime="2023-11-30T17:19:46+09:00">2023.11.30</time></p>
                                <h3 class="title"><span>冬だけの特別メニュー！スペシャルセットメニュー</span></h3>
                            </a>
                        </article>
                    </div><!-- END .news_list -->
                    <p class="button button_font"><a href="#">お知らせ一覧</a></p>
                </div>
                <div id="calendar">ここに施術者毎の予約済み施術カレンダー形式で表示される機能
                    <div class="container mt-5">
                        <h3 class="container mb-4 d-flex justify-content-center">
                            <span class="mx-3">2023年 11月</span>
                            <span class="mx-3">施術者名</span>
                        </h3>
                        <table class="table table-bordered">
                            <tr>
                                <th>日</th>
                                <th>月</th>
                                <th>火</th>
                                <th>水</th>
                                <th>木</th>
                                <th>金</th>
                                <th>土</th>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>1</td>
                                <td>2</td>
                                <td>3</td>
                                <td>4</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>6</td>
                                <td>7</td>
                                <td>8</td>
                                <td>9</td>
                                <td>10</td>
                                <td>11</td>
                            </tr>
                            <tr>
                                <td>12</td>
                                <td>13</td>
                                <td>14</td>
                                <td>15</td>
                                <td class="today">16</td>
                                <td>17</td>
                                <td>18</td>
                            </tr>
                            <tr>
                                <td>19</td>
                                <td>20</td>
                                <td>21</td>
                                <td>22</td>
                                <td>23</td>
                                <td>24</td>
                                <td>25</td>
                            </tr>
                            <tr>
                                <td>26</td>
                                <td>27</td>
                                <td>28</td>
                                <td>29</td>
                                <td>30</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div>
                    # ご利用方法
                    <section>
                        ## 個室のご案内<br>
                        大久保駅 出口からお電話にてご連絡ください。
                        <br>TEL 01-2345-6789 <br>
                        当店は個室にスタッフは待機しておりませんので予めご予約ください。
                    </section>
                    <section>
                        ## 部屋数
                        3部屋
                        <ul class="navbar-nav">## 設備/アメニティ
                            <li class="nav-item">サンプル/サンプル/サンプル</li>
                            <li class="nav-item">サンプル/サンプル/サンプル</li>
                            <li class="nav-item">サンプル/サンプル/サンプル</li>
                        </ul>
                    </section>
                    <section>
                        ## ご利用の流れ
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                STEP1<br>
                                本サイトからお好みのstaffをお選びください。<br>プロフィールのページでスタッフの情報をご覧ください。当店は店内にスタッフが待機しておりませんので、まずは本サイトからお選びいただくことをお勧め致します。
                            </li>
                            <li class="nav-item">
                                STEP2<br>
                                ご利用希望の日時をご確認ください。右側公式X（旧Twitter）よりスタッフの出勤予定をご確認ください。掲載されている内容は不規則に更新しているため、最新情報と異なる場合もございますので、次のSTEP3であわせてご相談ください。
                            </li>
                            <li class="nav-item">
                                STEP3<br>
                                電話かメールフォームでご予約ください。ご予約のページをご確認の上、電話かメールフォームでご予約ください。 当日ご利用希望の場合はお電話でのみご予約を承ります。ご予約後は次のSTEP4までお待ちくださいませ。
                            <li class="nav-item">
                                STEP4<br>
                                当店から折り返しのご連絡後、ご予約成立です。お客様からご予約をいただきましたら、当店からスタッフに出勤可否の確認をとり、お客様へ折り返しのご連絡を差し上げます。折り返し連絡をもちましてご予約成立となります。スタッフの状況（本業の勤務中など）によっては少々お時間をいただく場合もございます。
                            </li>
                            <li class="nav-item">
                                STEP5<br>
                                個室コースのお客様<br>
                                ご予約時間の5分前に、○○駅出口から当店へお電話ください。当店への道順をご案内致します。アクセスの詳細
                                STEP6<br>
                                指名のスタッフが入室後スタートです。ごゆっくりお楽しみください
                                出張コースのお客様<br>
                                スタッフに直接料金をお渡しください。お釣りが必要な場合はあらかじめご連絡いただけると幸いです。
                                個室コースのお客様<br>
                                個室到着後、フロアスタッフがお部屋までご案内致しますので、その際にご料金をお支払いいただきます。その後にスタッフが個室に入室致します。
                            </li>
                            <ul>
                                <li class="nav-item">
                                    出張コースのお客様<br>
                                    【ホテルへの出張】ホテル名・部屋番号を当店までご連絡ください。在室確認のお電話を差し上げる場合がございますのでご了承ください。<br>
                                    【ご自宅への出張】スタッフが最寄り駅に到着後、非通知設定でお電話を差し上げますので、ご自宅までの誘導をお願い致します。<br>
                                </li>
                            </ul>
                            <li class="nav-item">
                                STEP6 <br>
                                指名のスタッフが入室後スタートです。ごゆっくりお楽しみください<br>
                                出張コースのお客様<br>
                                スタッフに直接料金をお渡しください。お釣りが必要な場合はあらかじめご連絡いただけると幸いです。<br>
                                個室コースのお客様<br>
                                個室到着後、フロアスタッフがお部屋までご案内致しますので、その際にご料金をお支払いいただきます。その後にスタッフが個室に入室致します。
                            </li>
                        </ul>
                    </section>
                </div>
            </section>

            <aside class="col-md-6">
                <a class="twitter-timeline" href="https://twitter.com/bdAmDV8eHMYcDA6?ref_src=twsrc%5Etfw" data-height="1500">Tweets by bdAmDV8eHMYcDA6</a>
                <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </aside>
        </div>
        <div class="row justify-content-center">
            <div class="col-auto text-center" style="color: #fff;">
                <div class="campaign_banner">
                    <ul class="campaign_list hover_img">
                        <li>
                            <a href="#" alt="感染拡大防止対策強化中"><img src="/images/sphinx_corona_banner-1.jpg" alt="感染拡大防止対策強化中"></a>
                        </li>
                        <li>
                            <a href="#" target="_blank"> </a>
                        </li>
                    </ul>
                </div>
                <div class="footer_logo bg-black">
                    <div class="row justify-content-center">
                        <div class="col-md-12 text-center" style="color: #fff;">
                            <li>
                                <a href="#" target="_blank">
                                    <img src="/images/image.png" alt="sphinx_logo">
                                </a>
                            </li>
                            <div class="footer_info" style="color: #fff;">
                                <div class="info_phone">
                                    <span>お問い合わせ: </span>012-345-6789<br>
                                    <span>ご予約については本サイトよりお願いいたします。</span>
                                </div>
                                東京都新宿区百人町｜JR総武線 大久保駅すぐ
                                営業時間：年中無休 12:00 - 24:00
                                定休日：不定休
                            </div>
                            <ul class="footer-ul mx-auto list-unstyled nav">
                                <li class="nav-item">
                                    <span><a class="nav-link" href="/course_list" style="color: #fff;">コース一覧</a></span>
                                </li>
                                <li class="nav-item">
                                    <span><a class="nav-link" href=" /staffs" style="color: #fff;">スタッフ 一覧</a></span>
                                </li>
                                <li class="nav-item">
                                    <span><a class="nav-link" href="/Reservations.Reserve_create" style="color: #fff;">ご予約</a></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection