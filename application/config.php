<?php
// 合并配置并返回数组
return array_merge(
// 应用基础配置
    require_once sprintf("%sconfig.php", CONFIG_PATH),
    // 数据库配置
    require_once sprintf("%sdatabase.php", CONFIG_PATH),
    // redis配置
    require_once sprintf("%sredis.php", CONFIG_PATH)
);
