<template>
	<div class="editordiv">

		<medium-editor
			:text='text'
			:options='options'
			v-on:edit='applyTextEdit'>
		</medium-editor>
		<input type="hidden" name="body" id="body" :value='text' />

	</div>
</template>
<script>
	import editor from 'vue2-medium-editor';
	var options = {
			toolbar: {buttons: ['bold', 'strikethrough', 'h1']}
		}
	export default {
		props: ['body'],
		data() {
			return {
				 text: this.body ? this.body :'Protip: try selecting this text',
				 options: options,
				 title: '',
				}
	      },
	      components: {
	      	'medium-editor': editor
	      },

		methods: {
	        applyTextEdit: function (text) {
	          this.text = text
	        }
	    }
	    
    }
</script>
<style>
	.editordiv{
		border-left-style: solid;
		padding: 5px;
		width: 100%;
		background-color: #f2f2f2;
	}
</style>