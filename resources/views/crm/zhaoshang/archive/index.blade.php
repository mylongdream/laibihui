@extends('layouts.crm.app')

@section('content')
    <div class="crm-tabnav">
        <ul>
            <li><a href="{{ route('crm.zhaoshang.shop.index') }}">成功客户</a></li>
            <li class="on"><a href="{{ route('crm.zhaoshang.archive.index') }}">客户修改审核</a></li>
        </ul>
    </div>
    <div class="crm-main">
        <div class="crm-tabtit">
            <ul>
                <li class="{{ request('type') == 'passed' ? 'on' : '' }}"><a href="{{ route('crm.zhaoshang.archive.index', ['type' => 'passed']) }}">已通过修改</a></li>
                <li class="{{ request('type') == 'auditing' ? 'on' : '' }}"><a href="{{ route('crm.zhaoshang.archive.index', ['type' => 'auditing']) }}">待通过修改</a></li>
                <li class="{{ request('type') == 'rejected' ? 'on' : '' }}"><a href="{{ route('crm.zhaoshang.archive.index', ['type' => 'rejected']) }}">未通过修改</a></li>
            </ul>
        </div>
        <div class="crm-list mtw">
            @if (request('type') == 'passed')
                <table>
                    <tr>
                        <th align="left">商户名称</th>
                        <th align="left" width="150">通过时间</th>
                        <th align="left" width="150">提交时间</th>
                        <th align="left" width="80">操作</th>
                    </tr>
                    @if (count($archives))
                        @foreach ($archives as $value)
                            <tr>
                                <td><a href="{{ route('brand.shop.show',$value->shop_id) }}" target="_blank">{{ $value->shop->name }}</a></td>
                                <td>{{ $value->audited_at ? $value->audited_at->format('Y-m-d H:i') : '/' }}</td>
                                <td>{{ $value->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <a href="{{ route('crm.zhaoshang.archive.show',$value->id) }}">{{ trans('crm.view') }}</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="nodata">暂无数据</td>
                        </tr>
                    @endif
                </table>
            @endif
            @if (request('type') == 'auditing')
                <table>
                    <tr>
                        <th align="left">商户名称</th>
                        <th align="left" width="150">提交时间</th>
                        <th align="left" width="80">操作</th>
                    </tr>
                    @if (count($archives))
                        @foreach ($archives as $value)
                            <tr>
                                <td><a href="{{ route('brand.shop.show',$value->shop_id) }}" target="_blank">{{ $value->shop->name }}</a></td>
                                <td>{{ $value->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <a href="{{ route('crm.zhaoshang.archive.show',$value->id) }}">{{ trans('crm.view') }}</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="nodata">暂无数据</td>
                        </tr>
                    @endif
                </table>
            @endif
            @if (request('type') == 'rejected')
                <table>
                    <tr>
                        <th align="left">商户名称</th>
                        <th align="left" width="150">未通过原因</th>
                        <th align="left" width="150">未通过时间</th>
                        <th align="left" width="150">提交时间</th>
                        <th align="left" width="80">操作</th>
                    </tr>
                    @if (count($archives))
                        @foreach ($archives as $value)
                            <tr>
                                <td><a href="{{ route('brand.shop.show',$value->shop_id) }}" target="_blank">{{ $value->shop->name }}</a></td>
                                <td><a class="dropDown toggleExtra" href="javascript:;"><span>展开</span></a></td>
                                <td>{{ $value->audited_at ? $value->audited_at->format('Y-m-d H:i') : '/' }}</td>
                                <td>{{ $value->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <a href="{{ route('crm.zhaoshang.archive.show',$value->id) }}">{{ trans('crm.view') }}</a>
                                </td>
                            </tr>
                            <tr class="extra">
                                <td colspan="6">
                                    <div class="extra-reason">
                                        <p>请您核实，您提交的内容中可能存在以下问题： </p>
                                        <p style="color: red">{{ $value->reason }}</p>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="nodata">暂无数据</td>
                        </tr>
                    @endif
                </table>
            @endif
        </div>
        {!! $archives->appends(['name' => request('name')])->appends(['address' => request('address')])->links() !!}
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function(){
            $(".crm-list table").on("click", "tr .toggleExtra",function() {
                var e = $(this).parents("tr"),
                    a = e.next();
                if(a.hasClass("extra")){
                    a.siblings(".extra").css("display", "none");
                    e.siblings("tr").not(a).removeClass("on");
                    if("none" === a.css("display")){
                        a.css("display", "table-row").addClass("on");
                        e.addClass("on");
                    }else{
                        a.css("display", "none").removeClass("on");
                        e.removeClass("on")
                    }
                }
            });
        });
    </script>
@endsection