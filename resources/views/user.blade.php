<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ReTReK - ユーザー検索画面</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .fixed-top {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #fff;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 5px 0;
        }
        .container.d-flex {
            align-items: center;
            justify-content: space-between;
            padding: 0 15px;
        }
        .fixed-top h2 {
            margin: 0;
            color: #17a2b8;
            font-size: 1.25rem;
        }
        .btn.back-button {
            padding: 5px 10px;
            font-size: 0.875rem;
        }

        section {
            margin-top: 60px; 
        }
        section h3 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: #17a2b8;
        }
        .list-group-item {
            margin-bottom: 15px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            background-color: #f8f9fa;
        }
        .list-group-item h5 {
            font-size: 1.25rem;
            margin-bottom: 10px;
            color: #343a40;
        }
        .button-container {
            display: flex; 
            gap: 10px; 
        }
        .favorite-button,
        .remove-button {
            padding: 5px 10px;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <div class="fixed-top">
        <div class="container d-flex justify-content-between align-items-center">
            <h2 class="mb-4" style="color: #17a2b8;">ユーザー検索画面</h2>
            <form action="{{ route('profile.edit') }}" method="GET" class="mb-3">    
                <button  class="btn btn-primary back-button">profile</button>
            </form>
        </div>
    </div>
    
    <div class="container mt-5">
        
        <form action="{{ route('exepy') }}" method="POST" class="mb-3">
            @csrf
            <div class="form-group">
<br>
<div id="smiBox">
                <label for="smiles">SMILES化学式:</label>
                <input type="text" name="smiles" class="form-control" id="smiles" required>
</div>
<div id="subBox">
                <label for="substance">物質名(保存ファイル名/空欄なら日付を利用):</label>
                <input type="text" name="substance" class="form-control" id="substance">
</div>
            </div>
                
            <fieldset>
                <legend class="mb-3">詳細設定</legend>

                <div class="form-group row mb-2">
                    <label for="route" class="col-sm-4 col-form-label">ルート数:</label>
                    <div class="col-sm-8">
                        <input type="number" id="route" name="route_num" class="form-control" required value="100" min="1">
                    </div>
                </div>
		@php
		$weight=array("5.0","0.5","2.0","2.0","2.0","1.0")
		@endphp
                <div class="form-group row mb-2">
                    <label class="col-sm-4 col-form-label">knowledgeWeights:</label>
                    <div class="col-sm-8">
                        <div class="row">
                            @for ($i = 0; $i < 6; $i++)
                                <div class="col">
                                    <input type="number" class="form-control mb-2" name="weights[]" id=weights[{{ $i }}] step="0.1" value="{{$weight[$i]}}" placeholder="{{ $i + 1 }}"  required>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label for="expansion_num" class="col-sm-4 col-form-label">expansion_num:</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control"  id="expansion_num" name="expansion_num" value="50" required>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label for="selection_constant" class="col-sm-4 col-form-label">selection_constant:</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control"  name="selection_constant" id="selection_constant" value="10" required>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label for="time_limit" class="col-sm-4 col-form-label">time_limit:</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" name="time_limit" id="time_limit" value="0" required>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-4 col-form-label" for="save_tree">save_tree:</label>
                    <div class="col-sm-8">
                        <div class="form-check">
                            <input type="checkbox" name="save_tree" class="form-check-input" id="save_tree" value="True">
                            <label class="form-check-label" for="save_tree"></label>
                        </div>
                    </div>
                </div>                

                <div class="form-group row mb-2">
                    <label class="col-sm-4 col-form-label" for="cum_prob_mod">cum_prob_mod:</label>
                    <div class="col-sm-8">
                        <div class="form-check">
                            <input type="checkbox" name="cum_prob_mod" class="form-check-input" id="cum_prob_mod" value="True">
                            <label class="form-check-label" for="cum_prob_mod"></label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-4 col-form-label" for="chem_axon">chem_axon:</label>
                    <div class="col-sm-8">
                        <div class="form-check">
                            <input type="checkbox" name="chem_axon" class="form-check-input" id="chem_axon" value="True">
                            <label class="form-check-label" for="chem_axon"></label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-4 col-form-label">interface:</label>
                    <div class="col-sm-8">
                <div class="form-group row mb-2">
			<div>
                            <input type="radio" name="cui" class="form-check-input" id="Original" value="1" onchange="showCSV()">
			<label style="width:90px" for="Original">Original</label>
			</div>
			<div>
                            <input type="radio" name="cui" class="form-check-input" id="Single" value="2" checked onchange="showCSV()">
			<label style="width:100px" for="Original">Advanced</label>
			</div>
			<div>
                            <input type="radio" name="cui" class="form-check-input" id="fromFile" value="3" onchange="showCSV()">
			<label style="width:100px" for="fromFile">fromFile</label>
			</div>
                            <label class="form-check-label" for="cui"></label>
                    </div>
                    </div>
                </div>
<div id="csvBox" style="display:none">
CSV ファイルの読み込み
<input type="file" id="getfile">
<input type="text" name="fromCSV" class="form-control" id="fromCSV" value="id#,smiles,ops,,," >
</div>
            </fieldset>
            <button type="submit" class="btn btn-primary">検索</button>
        </form>

        <section>
            <h3>お気に入りの合成経路</h3>  
            <ul class="list-group">
                @forelse($favoriteRoutes as $route)
                    <li class="list-group-item">
                        <h5>{{ $route->smiles }}の合成経路</h5>
                        <div class="button-container">
                        <form action="{{ route('favorite') }}" method="POST" class="favorite-form">
                            @csrf
                            <input type="hidden" name="smiles" value="{{ $route->smiles }}">
                            <input type="hidden" name="route_id" value="{{ $route->route_id }}">
                            <input type="hidden" name="route_num" value="{{ $route->route_num }}">
                            <input type="hidden" name="knowledge_weights" value="{{ $route->knowledge_weights }}">
                            <input type="hidden" name="save_tree" value="{{ $route->save_tree ? 'true' : 'false' }}">
                            <input type="hidden" name="expansion_num" value="{{ $route->expansion_num }}">
                            <input type="hidden" name="cum_prob_mod" value="{{ $route->cum_prob_mod ? 'true' : 'false' }}">
                            <input type="hidden" name="chem_axon" value="{{ $route->chem_axon ? 'true' : 'false' }}">
                            <input type="hidden" name="cui" value="{{ $route->cui }}">
                            <input type="hidden" name="selection_constant" value="{{ $route->selection_constant }}">
                            <input type="hidden" name="time_limit" value="{{ $route->time_limit }}">
                            <input type="hidden" name="fromCSV" value="{{ $route->fromCSV }}">
                            <button type="submit" class="btn btn-primary favorite-button">表示</button>
                        </form>
                        <form action="{{ route('remove') }}" method="POST" class="remove-route">
                            @csrf
                            <input type="hidden" name="smiles" value="{{ $route->smiles }}">
                            <input type="hidden" name="route_id" value="{{ $route->route_id }}">
                            <input type="hidden" name="route_num" value="{{ $route->route_num }}">
                            <input type="hidden" name="knowledge_weights" value="{{ $route->knowledge_weights }}">
                            <input type="hidden" name="save_tree" value="{{ $route->save_tree ? 'true' : 'false' }}">
                            <input type="hidden" name="expansion_num" value="{{ $route->expansion_num }}">
                            <input type="hidden" name="cum_prob_mod" value="{{ $route->cum_prob_mod ? 'true' : 'false' }}">
                            <input type="hidden" name="chem_axon" value="{{ $route->chem_axon ? 'true' : 'false' }}">
                            <input type="hidden" name="cui" value="{{ $route->cui ? 'true' : 'false' }}">
                            <input type="hidden" name="fromCSV" value="{{ $route->fromCSV }}">
                            <input type="hidden" name="selection_constant" value="{{ $route->selection_constant }}">
                            <input type="hidden" name="time_limit" value="{{ $route->time_limit }}">
                            <button type="submit" class="btn btn-primary favorite-button">お気に入りから削除</button>
                        </form>
                    </div>
                    </li>
                @empty
                    <li class="list-group-item">お気に入りの合成経路はありません。</li>
                @endforelse
            </ul>
        </section>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
var fetch=function(url,inerval){
	$.ajax({
		type: 'GET',
		url: url,
		processData: false,
		contentType: false
}).then(function(res){
	consol.log(res);
	if (res.statu==='Done'){clarInterval(interval);}
});
};

var progress = function(url){
	var interval = setInterval(fetch,1000,url,interval);
};

        $(document).ready(function() {
            $('form.remove-route').on('submit', function(e) {
                e.preventDefault(); // 通常のフォーム送信を停止

                var form = $(this);
                var url = form.attr('action');

                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(), 
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), 
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    success: function(data) {
                    if (data.isFavorite) {
                        alert('Error removing route');
                    } else { 
                        form.closest('li.list-group-item').remove();
                        alert(data.message);
                    }
                    },
                    error: function(xhr, status, error) {
                        alert('エラーが発生しました: ' + xhr.responseText);
                    }
                });
            });
        });
    </script>
<script>
// komai
//

function showCSV(){
//fileInput=document.getElementById("getfile");
	cui=document.getElementsByName("cui");
	csvBox=document.getElementById("csvBox");
	smiles=document.getElementById("smiles");
	subBox=document.getElementById("subBox");
	smiBox=document.getElementById("smiBox");
	if (cui[2].checked){// fromFile
		csvBox.style.display='block';
		smiles.required=false;
		smiBox.style.display='none';
		subBox.style.display='none';
	}else if (cui[1].checked){//'single'
		csvBox.style.display='none';
		smiBox.style.display='block';
		subBox.style.display='block';
		smiles.required=true;
	}else{// Original
		csvBox.style.display='none';
		subBox.style.display='none';
		smiBox.style.display='block';
		smiles.required=true;
	};

};
const fileInput=document.getElementById("getfile");
	fileInput.addEventListener("change",function(event){
		const file = event.target.files[0];
		readFile(file);
	});
	function readFile(file){
		const reader = new FileReader();
		reader.onload = function (event) {
		document.getElementById("fromCSV").value=event.target.result;
		};
		reader.readAsText(file);
	};
</script>
</body>
</html>
