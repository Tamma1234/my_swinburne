<h3>Thông tin đặt phòng </h3>
<div>
    <div class="">
        <div class="aHl"></div>
        <div id=":g3" tabindex="-1"></div>
        <div id=":fs" class="ii gt">
            <div id=":fr" class="a3s aiL msg-8525905254478487520"><u></u>
                <div>
                    <h3>
                        Xin chào {{ $full_name }}
                    </h3>
                    <p>Em đã đăng ký tài khoản dự thi trên Swinburne, giờ em hãy ấn confirm để kích hoạt tài khoản nhé!</p>
                    <p>Thông tin tài khoản:</p>
                    <div class="m_-8525905254478487520table-responsive">
                        <table border="1" style="width:50%;margin-left:200px">
                            <tbody>
                            <tr>
                                <th>Full Name</th>
                                <td>{{$full_name}}</td>
                            </tr>
                            <tr>
                                <th>Email </th>
                                <td>{{$email}}</td>
                            </tr>
                            <tr>
                                <th>Phone Number</th>
                                <td><span>{{$phone_number}}</span></td>
                            </tr>
                            <tr>
                                <th>Password</th>
                                <td><span>{{$password}}</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <p class="m_-8525905254478487520confirm-block" style="margin-left: 35%">
                        <a href="{{ route('confirm', ['email' => $email]) }}" style="background: red;padding:10px;text-decoration:none;color:white" target="_blank">Confirm</a>
                    </p>
                    <div class="yj6qo"></div>
                    <div class="adL">
                    </div>
                </div>
                <div class="adL">
                </div>
            </div>
        </div>
        <div id=":g7" class="ii gt" style="display:none">
            <div id=":g8" class="a3s aiL "></div>
        </div>
        <div class="hi"></div>
    </div>
</div>
