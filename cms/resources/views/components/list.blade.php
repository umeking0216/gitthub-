<div class="flex justify-between p-4 items-center bg-blue-500 text-white rounded-lg border-2 border-white">
    <!-- チーム名 -->
		<div>{{ $team->team_name }}</div>

		<!-- オーナー名 -->
    <div>{{ $team->user->name }}</div>

		<!-- 所属人数 -->
    <div>{{ $team->members()->count() }}人参加中</div>


  
    <div>
        <form action="{{ url('/teamssedit/'.$id) }}" method="GET">
             @csrf
            <button type="submit"  class="btn bg-blue-500 rounded-lg">
                詳細
            </button>
        </form>
    </div>
    
     @if(Auth::check())
    	@if(Auth::id() != $team->user_id && $team->members()->where('user_id',Auth::id())->exists() !== true)
	         <form action="{{ url('/team/'.$id) }}" method="GET">
	         @csrf
	        <button type="submit"  class="btn bg-blue-500 rounded-lg">
	            チーム参加
	        </button>
	        </form>
    	@endif
    @endif
    

</div>