<?php

namespace Lzy\Express\Test;

use Lzy\Express\Exceptions\HttpException;
use Lzy\Express\Exceptions\InvalidArgumentException;
use Lzy\Express\Express;
use Lzy\Express\Kuaidi100Express;
use Lzy\Express\KuaidiBirdExpress;
use PHPUnit\Framework\TestCase;

class HttpTest extends TestCase
{

    //不传参
    public function testKuaidiBird()
    {
        $kuaidiBirdExpress = new KuaidiBirdExpress('express_id','express_key');
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('TrackingCode is required');
        $kuaidiBirdExpress->query();
        $this->fail('失败.');
    }

    public function testKuaidi100()
    {
        $kuaidi100Express = new Kuaidi100Express('express_id','express_key');
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('TrackingCode is required');
        $kuaidi100Express->query();
        $this->fail('失败.');
    }

    //只传tracking code

    /**
     * @throws HttpException
     */
    public function testKuaidiBirdship_code(){
        $kuaidiBirdExpress = new KuaidiBirdExpress('express_id','express_key');
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('ShippingCode is required');
        $kuaidiBirdExpress->query('666666666');
        $this->fail('失败.');

    }

    /**
     * @throws HttpException
     */
    public function testKuaidi100ship_code(){
        $kuaidi100Express = new Kuaidi100Express('express_id','express_key');
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('ShippingCode is required');
        $kuaidi100Express->query('666666666');
        $this->fail('失败.');

    }

    /**
     * @throws HttpException
     */
    public function testKuaidi100ship_code_not(){
        $kuaidi100Express = new Kuaidi100Express('075B7D4A53884E185B068A43D12CE87E','uKtocMtn5796');
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('ship_code not found');
        $kuaidi100Express->query('666666666','test');
        $this->fail('失败.');

    }

    /**
     * @throws HttpException
     */
    public function testKuaidiBirdship_code_not(){
        $kuaidiBirdExpress = new KuaidiBirdExpress('075B7D4A53884E185B068A43D12CE87E','uKtocMtn5796');
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('ship_code not found');
        $kuaidiBirdExpress->query('666666666','test');
        $this->fail('失败.');

    }
}