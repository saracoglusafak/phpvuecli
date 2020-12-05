<?php
class PHPVueCli
{
    protected $dir_components;

    public function __construct($dir = "phpvuecli/components/")
    {
        $this->dir_components = $dir;
    }

    public function run($run = ".phpvuecli")
    {
?>
        <script>
            var vues = document.querySelectorAll('<?= $run ?>');
            // console.log(vues.length);
            for (var index = 0; index < vues.length; index++) {
                // console.log(vues[index]);
                new Vue({
                    el: vues[index],
                    data: {
                        loading: true
                    },
                    created() {
                        // console.log(GLOBALS);
                        this.loading = false;
                    },
                });
            }
        </script>
<?php
    }

    public function load(string $file)
    {
        $LoadFile = $this->dir_components . $file . ".vue";
        // echo $LoadFile;
        if (!file_exists($LoadFile)) return;
        if (!$loaded = file_get_contents($this->dir_components . $file . ".vue")) return;
        preg_match('~<template>(.*?)</template>~usmi', $loaded, $template);
        if (!isset($template[1])) return;
        $loaded = preg_replace('~<template>(.*?)</template>~usmi', '', $loaded);
        $loaded = preg_replace('~template:\s*`.*?`~usmi', 'template: `' . $template[1] . '`', $loaded);
        return $loaded;
    }

    public function allLoad($glob = "*")
    {
        if (!$VUES = glob($this->dir_components . $glob . '.vue')) return;
        foreach ($VUES as $k => $v) {
            $load = str_replace($this->dir_components, '', $v);
            $load = str_replace('.vue', '', $load);
            // echo $load;
            echo $this->load($load);
        };
        $this->run();
    }
}
$GLOBALS["SFX"]["PHPVueCli"] = new PHPVueCli(sfxplugin_plugin_libs . "phpvuecli/components/");
