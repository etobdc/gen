<template>
		<div class="box box-widget">
			<div class="box-header">
				<div class="row">
					<div class="col-md-8 col-sm-6">
						<h3 class="box-title">{{title}}</h3>
					</div>
					<div class="col-md-4 col-sm-6">
						<form method="GET" class="form-horizontal" :action="url">
							<div class="input-group">
								<input type="text" name="busca" class="form-control" placeholder="Busca por" :value="busca">
								<span class="input-group-btn">
									<button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-search"></i></button>
									<a :href="url" class="btn btn-default btn-flat" data-toggle="tooltip" title="Limpar Busca"><i class="fa fa-list"></i></a>
								</span>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="box-body">

				<slot></slot>

				<form v-if="items.data.length > 0" :class="formClass" v-on:submit.prevent="confirmDelete" :action="url + '/destroy'" method="POST">
					<input type="hidden" name="_token" :value="token" />
					<input type="hidden" name="_method" value="DELETE" />
					<table id="example1" class="table table-bordered table-striped table-list">
						<thead>
							<tr>
								<th align="center" width="50px" v-if="enableDelete">
									<input class="checkbox-delete" id="checkbox-delete-origin" type="checkbox" name="registro[]" data-toggle="tooltip" title="Marcar tudo" v-on:click="checkAll">
								</th>
								<th v-for="(title, index) in titles">{{title}}</th>
								<th v-if="actions.length">Ações</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="item in items.data">
								<th align="center" class="v-middle" v-if="enableDelete">
									<input class="checkbox-delete" type="checkbox" name="registro[]" :value="item.id">
								</th>
								<td v-for="field in item" class="v-middle">
									<span v-if="field === null">{{field}}</span>
									<span v-else-if="!field.type">{{field}}</span>

									<span v-else-if="field.type == 'img'">
										<img :src="field.src" style="max-width:200px; max-height:200px;">
									</span>

									<span v-else-if="field.type == 'label'" class="label" :class="'label-' + field.status">{{ field.text }}</span>

									<a v-else-if="field.type == 'url'" :href="field.href" :target="field.target">{{ field.label }}</a>
								</td>
								<td class="v-middle" v-if="actions.length">
									<span v-for="action in actions">
										<a data-toggle="tooltip"
											class="btn btn-flat ml-10"
											:class="'btn-' + action.color"
											:href="url + '/' + actionUrl(action.path, item.id)"
											:title="action.label">
											<i :class="action.icon"></i>
										</a>&nbsp;
									</span>
								</td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td :colspan="(titles.length + 2)" align="left" vertical-align="center">
									<button v-if="enableDelete" type="submit" class="mv-22 btn btn-flat btn-danger" :disabled="btnDelete.disabled">
										<i :class="btnDelete.icon"></i> {{ btnDelete.text }}
									</button>
									<slot name="pagination"></slot>
								</td>
							</tr>
						</tfoot>
					</table>
				</form>

				<div v-if="items.data.length == 0" class="callout callout-default">
	                <h4>Nenhum registro encontrado!</h4>
	              </div>

			</div>
		</div>
</template>

<style>
	.mv-22{
		margin: 22px 0;
	}

	.v-middle{
		vertical-align: middle !important;
	}

	.table-list td, .table-list td{
		max-width: 500px;
	}
</style>

<script>
	export default {
		props: ['title', 'titles', 'items', 'actions', 'busca', 'enableDelete', 'url', 'token', 'formClass'],
		data : function(){
			return {
				deleteItems : [],
				btnDelete : {
					'icon' : 'fa fa-trash',
					'text' : 'Excluir registros selecionados',
					'disabled' : false
				}
			}
		},
		methods: {
			checkAll : function(){
				var checkboxOrigin = document.getElementById('checkbox-delete-origin');
				var checkboxes = document.getElementsByClassName('checkbox-delete');
				  for(var i=0, n=checkboxes.length;i<n;i++) {
				  	checkboxes[i].checked = checkboxOrigin.checked;
				  }
			},
			actionUrl: (path, id) => {
				return path.replace(/{item}/g, id);
			},
			confirmDelete : function(e){
				this.$swal({
					title: 'Atenção!',
					text: "Deseja realmente excluir os registros selecionados?",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#008d4c',
					cancelButtonColor: '#d4d4d4',
					confirmButtonText: 'Sim, deletar!',
					cancelButtonText: 'Não!'
				}).then((result) => {
				  	e.target.submit(),
				  	this.btnDelete.icon = 'fa fa-spinner fa-pulse';
					this.btnDelete.text = 'Excluindo';
					this.btnDelete.disabled = true;
				});
			}
		}
	}
</script>
