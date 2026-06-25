<?php

namespace Atlasbaz\Audits;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

interface Audit_Interface {

	public function run(): array;
}