<?php

namespace Adaptivemedia\EmailQueueChecker\Test;

use Adaptivemedia\EmailQueueChecker\EmailQueueChecker;

class EmailQueueCheckerTest extends TestCase
{
    /** @test */
    public function an_email_can_be_filled_with_correct_properties()
    {
        // Load config stub into config
        $this->loadConfigStub('ok_config_stub.php');

        $service = new EmailQueueChecker;
        $model = $service->addEmailToQueue();

        $this->assertEquals('test_system_name', $model->attributes['from_name']);
        $this->assertEquals('system_name@emailchecker.adaptivemail.se', $model->attributes['from_email']);
        $this->assertEquals('info@domain.com', $model->attributes['to_email']);
        $this->assertEquals('Emailchecker for test_system_name', $model->attributes['subject']);
        $this->assertEquals('OK', $model->attributes['body']);
    }

    /**
     * @test
     */
    public function exception_is_thrown_when_invalid_model_class_is_supplied()
    {
        $this->expectException(\Adaptivemedia\EmailQueueChecker\Exceptions\BadModelInConfigException::class);

        // Load config stub into config
        $this->loadConfigStub('bad_model_config_stub.php');

        $service = new EmailQueueChecker;
        $service->addEmailToQueue();
    }

    /**
     * @test
     */
    public function exception_is_thrown_when_invalid_key_is_supplied()
    {
        $this->expectException(\Adaptivemedia\EmailQueueChecker\Exceptions\BadColumnInConfigException::class);

        // Load config stub into config
        $this->loadConfigStub('bad_column_config_stub.php');

        $service = new EmailQueueChecker;
        $service->addEmailToQueue();
    }

    /**
     * @test
     */
    public function exception_is_thrown_when_invalid_value_is_supplied()
    {
        $this->expectException(\Adaptivemedia\EmailQueueChecker\Exceptions\BadValueInConfigException::class);

        // Load config stub into config
        $this->loadConfigStub('bad_value_config_stub.php');

        $service = new EmailQueueChecker;
        $service->addEmailToQueue();
    }
}
