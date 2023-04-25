<?php

$software = [
  ["nombre" => "Microsoft Word", "creador" => "Microsoft", "plataforma" => "Windows, macOS", "version" => "16.0", "licencia" => "Propietaria"],
  ["nombre" => "Google Chrome", "creador" => "Google", "plataforma" => "Windows, macOS, Linux", "version" => "90.0.4430.85", "licencia" => "Open Source"],
  ["nombre" => "Adobe Photoshop", "creador" => "Adobe", "plataforma" => "Windows, macOS", "version" => "2021", "licencia" => "Propietaria"],
  ["nombre" => "Mozilla Firefox", "creador" => "Mozilla Foundation", "plataforma" => "Windows, macOS, Linux", "version" => "88.0", "licencia" => "Open Source"],
  ["nombre" => "VLC Media Player", "creador" => "VideoLAN", "plataforma" => "Windows, macOS, Linux", "version" => "3.0.13", "licencia" => "Open Source"],
  ["nombre" => "GitHub Desktop", "creador" => "GitHub", "plataforma" => "Windows, macOS", "version" => "2.8.4", "licencia" => "Open Source"],
  ["nombre" => "Ubuntu", "creador" => "Canonical Ltd.", "plataforma" => "Linux", "version" => "21.04", "licencia" => "Open Source"]
];

echo json_encode($software);