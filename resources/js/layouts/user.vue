<template>
    <theHeaderUser />
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 d-none d-sm-flex">
                <a-list bordered style="width: 100%;">
                    <template #header>
                        <div class="text-center">Bang dieu khien</div>
                    </template>
                    <TheMenuUser />
                </a-list>
            </div>
            <div class="col-sm-9 col-12 bg-light">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script setup>
    import theHeaderUser from '../components/theHeaderUser.vue';
    import TheMenuUser from '../components/theMenuUser.vue';
</script>