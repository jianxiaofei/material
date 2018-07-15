<template>
	<div class="wrapper">
		<swiper :options="swiperOption"   v-if="showSwiper">
			<!-- slides -->
			<swiper-slide v-for='item of swiper' :key="item.id">
				<img class="swiper-img" :src="item.imgUrl">
			</swiper-slide>
			<!-- Optional controls -->
			<div class="swiper-pagination"  slot="pagination"></div>
		</swiper>
	</div>
</template>

<script>
	export default {
		name: 'HomeSwiper',
		props:{
			swiper: Array
		},
		data () {
			return {
				swiperOption:{
					pagination:'.swiper-pagination',
					loop: true,
					autoplay: 2000
				}
			}
		},
		computed:{
			showSwiper () {
				return this.swiper.length
			}
		}
	}
</script>
<style lang="stylus" scoped>
	.wrapper >>> .swiper-pagination-bullet-active
		background:#fff
	.wrapper
		overflow:hidden
		width:100%
		height:0
		padding-bottom:32.25%
		bacground:#ccc
		.swiper-img
			width:100%
</style>