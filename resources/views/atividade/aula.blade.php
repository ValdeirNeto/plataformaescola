<html itemscope itemtype="http://schema.org/Product" prefix="og: http://ogp.me/ns#" xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
    </head>
    <body>
        <script src="https://meet.jit.si/external_api.js"></script>
        <script>
            var domain = "meet.jit.si";
            var options = {
                roomName: '<?= $classe_nome ?>',
                parentNode: undefined,
                configOverwrite: {

                },
                interfaceConfigOverwrite: {
                    filmStripOnly: false,
                    VERTICAL_FILMSTRIP: true,
                    DEFAULT_REMOTE_DISPLAY_NAME: "<?= Auth::user()->name ?>",
                    DEFAULT_LOCAL_DISPLAY_NAME: 'Eu',
                    <?php if(in_array(Auth::user()->permissao, ['professor','coordenador','admin'])) :?>
                        TOOLBAR_BUTTONS: [
                            'microphone', 'camera', 'closedcaptions', 'desktop', 'fullscreen',
                            'fodeviceselection', 'hangup', 'profile', 'chat', 'recording',
                            'etherpad', 'settings', 'raisehand',
                            'videoquality', 'filmstrip', 'feedback', 'shortcuts',
                            'tileview', 'download', 'help', 'mute-everyone',
                            'e2ee'
                        ],
                    <?php else: ?>
                        TOOLBAR_BUTTONS: [
                            'microphone', 'camera', 'closedcaptions', 'fullscreen',
                            'fodeviceselection', 'hangup', 'profile', 'chat',
                            'etherpad',  'settings', 'raisehand',
                            'videoquality', 'filmstrip', 'feedback', 'shortcuts',
                            'tileview', 'download', 'help',
                            'e2ee'
                        ],
                    <?php endif; ?>
                    SHOW_CHROME_EXTENSION_BANNER: false,
                },
            }
            var api = new JitsiMeetExternalAPI(domain, options);
        </script>
    </body>
</html>