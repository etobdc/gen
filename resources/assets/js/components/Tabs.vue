<template>
	<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
          <li v-for="(tab,index) in tabs" v-bind:class="{'active' : activeTab == index}">
          	<a v-bind:href="'#tab_' + index" data-toggle="tab"><i v-bind:class="tab.icon"></i> {{tab.title}}</a>
          </li>
        </ul>
        <div class="tab-content">
        	<div v-for="(tab,index) in tabs" class="tab-pane" v-bind:class="{'active' : activeTab == index}" v-bind:id="'tab_' + index">
          		<slot v-bind:name="'tabslot_' + index"></slot>
    		</div>
    	</div>
    </div>
</template>

<script>
	export default {
		props: ['tabs','activeTab', 'lalala']
	}
</script>
