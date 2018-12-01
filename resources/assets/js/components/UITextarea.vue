<template>
	<span>
		<vue-editor :id="name" v-model="editor.content" :editorToolbar="editor.customToolbar"></vue-editor>
		<input type="hidden" :name="name" :value="editor.content">
	</span>
 </template>
 
<script>
   import { VueEditor } from 'vue2-editor'
 
	export default {
	   	props : ['name', 'value'],
		data : function() {
			return {
	       		editor : {
		         	customToolbar: [
			            ['bold', 'italic', 'underline'],
			            [{ 'list': 'ordered'}, { 'list': 'bullet' }]
		      		],
		      		style : 'font-size:12px!important',
		      		content: this.value
	       		}
			}
	    },
	    created : function (){
	    	console.log(VueEditor);
	    },
	    components: {
			VueEditor
		} 
   }
 </script> 

<style>
	.ql-editor{
		font-size: 14px !important;
		font-family: inherit !important;
	}
</style>