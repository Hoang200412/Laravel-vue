<template>
    <theHeader/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 d-none d-sm-flex">
                <a-list bordered style="width: 100%;">
                    <template #header>
                    <div class="text-center">Bang dieu khien</div>
                    </template>
                    <TheMenu/>
                </a-list>
            </div>
            <div class="col-sm-9 col-12">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script >
    import theHeader from '../components/theHeader.vue';
    import TheMenu from '../components/theMenu.vue';

    export default {
        components : {
            theHeader,
            TheMenu
        }
    }
</script>