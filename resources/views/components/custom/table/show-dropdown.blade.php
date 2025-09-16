<div class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
    <ul class="link-check">
        <li><span>Show</span></li>
        @foreach ($this->show as $s)
        <li class="{{ $this->perPage == $s ? 'active' : '' }}">
            <a href="javascript:void(0)" wire:click.prevent="$set('perPage',{{ $s }} )">{{ $s }}</a>
        </li>
        @endforeach
    </ul>
    <ul class="link-check">
        <li><span>Order</span></li>
        <li class="{{ $this->order == 'asc' ? 'active' : '' }}">
            <a href="javascript:void(0)" wire:click.prevent="$set('order','asc')">ASC</a>
        </li>
        <li class="{{ $this->order == 'desc' ? 'active' : '' }}">
            <a href="javascript:void(0)" wire:click.prevent="$set('order','desc')">DESC</a>
        </li>
    </ul>
</div>
