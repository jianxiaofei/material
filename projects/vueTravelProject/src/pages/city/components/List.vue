<template>
	<div class="list" ref="wrapper">
		<div>
			<div class="area">
				<div class="title border-topbottom">当前城市</div>
				<div class="button-list">
					<div class="button-wrapper">
						<div class="button">{{this.currentCity}}</div>	
					</div>
				</div>
			</div>
			<div class="area">
				<div class="title  border-topbottom">热门城市</div>
				<div class="button-list">
					<div class="button-wrapper" 
					 v-for="city of hotCities"
					 :key="city.id"
					 @click="handleCityClick(city.name)"	
					>
						<div class="button">{{city.name}}</div>	
					</div>
				</div>
			</div>
			<div class="area" :id="key"
				 v-for="(listCity,key) in allCities"
				 :key="key"
				 :ref="key"
				 >
				<div class="title  border-topbottom" >{{key}}</div>
				<div class="item-list">
					<div class="item border-bottom"
						v-for="singleCity in listCity"
				 		:key="singleCity.id"
				 		@click="handleCityClick(singleCity.name)"
						>
						{{singleCity.name}}
					</div>		
				</div>
			</div>
		</div>
	</div>
</template>
<script>
import {mapState, mapMutations} from 'vuex'
import Bscroll from 'better-scroll'
	export default{
		name: 'CityList',
		props: {
			allCities: Object,
			hotCities: Array,
			letter: String
		},
		computed:{
			...mapState({
				currentCity: 'city'
			})
		},
		mounted () {
			this.scroll = new Bscroll(this.$refs.wrapper)
		},
		watch:{
			letter () {
				if (this.letter) {
					const element = this.$refs[this.letter][0]
					this.scroll.scrollToElement(element)	
				}
			}
		},
		methods:{
			handleCityClick (city) {
				console.log(11)
				this.changeCity(city)
				this.$router.push('/')
			},
			...mapMutations(['changeCity'])
		}
	}
</script>
<style lang="stylus" scoped>
@import '~styles/varibles.styl'
.border-topbottom
	&:before
		border-color:#ccc
	&:after
		border-color:#ccc
.border-bottom	
	&:before
		border-color:#ccc
.list
	overflow:hidden
	position:absolute
	top:1.58rem
	bottom:0
	left:0
	right:0
	.title
		line-height:.54rem
		background:#eee
		padding-left:.2rem
		color:#666
		font-size:.26rem
	.button-list
		padding:.1rem .6rem .1rem .1rem
		overflow:hidden
		.button-wrapper
			width:33.33%
			float:left
			.button
				margin:.1rem
				padding:.1rem 0
				text-align:center
				border:.02rem solid #ccc
				border-radius:.06rem
	.item-list
		.item
			line-height:.64rem
			color:#666
			padding-left:.2rem	
</style>